<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class PostController extends Controller
{
    /**
     * index
     *
     * @return PostResource
     */
    public function index()
    {
        try {
            $posts = Post::latest()->paginate(5);
            return new PostResource(true, 'List Data Posts', $posts);
        } catch (Exception $e) {
            return new PostResource(false, 'Terjadi kesalahan: ' . $e->getMessage(), null);
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return PostResource
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'title'     => 'required',
                'content'   => 'required',
                'nama_penulis' => 'required',
                'nama_divisi' => 'required',
            ]);

            if ($validator->fails()) {
                return new PostResource(false, 'Validasi gagal', $validator->errors());
            }

            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post = Post::create([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
                'nama_penulis' => $request->nama_penulis,
                'nama_divisi' => $request->nama_divisi,
            ]);

            return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
        } catch (Exception $e) {
            return new PostResource(false, 'Terjadi kesalahan: ' . $e->getMessage(), null);
        }
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return PostResource
     */
    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
            return new PostResource(true, 'Detail Data Post!', $post);
        } catch (ModelNotFoundException $e) {
            return new PostResource(false, 'Data Post tidak ditemukan!', null);
        } catch (Exception $e) {
            return new PostResource(false, 'Terjadi kesalahan: ' . $e->getMessage(), null);
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return PostResource
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'     => 'required',
                'content'   => 'required',
                'nama_penulis' => 'required',
                'nama_divisi' => 'required',
            ]);

            if ($validator->fails()) {
                return new PostResource(false, 'Validasi gagal', $validator->errors());
            }

            $post = Post::findOrFail($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image->storeAs('public/posts', $image->hashName());

                Storage::delete('public/posts/' . basename($post->image));

                $post->update([
                    'image' => $image->hashName(),
                    'title' => $request->title,
                    'content' => $request->content,
                    'nama_penulis' => $request->nama_penulis,
                    'nama_divisi' => $request->nama_divisi,
                ]);
            } else {
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'nama_penulis' => $request->nama_penulis,
                    'nama_divisi' => $request->nama_divisi,
                ]);
            }

            return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
        } catch (ModelNotFoundException $e) {
            return new PostResource(false, 'Data Post tidak ditemukan!', null);
        } catch (Exception $e) {
            return new PostResource(false, 'Terjadi kesalahan: ' . $e->getMessage(), null);
        }
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return PostResource
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            Storage::delete('public/posts/'.basename($post->image));
            $post->delete();
            return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
        } catch (ModelNotFoundException $e) {
            return new PostResource(false, 'Data Post tidak ditemukan!', null);
        } catch (Exception $e) {
            return new PostResource(false, 'Terjadi kesalahan: ' . $e->getMessage(), null);
        }
    }
}