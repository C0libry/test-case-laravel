<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

// use File;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'images' => ['required', 'array', 'max:5'],
            'images.*' => ['required', 'image:jpg, jpeg, png']
        ]);

        foreach ($request->file('images') as $file) {
            $image = new Image;
            $name = $file->getClientOriginalName();
            $name = $this->transliterate($name);
            $name = strtolower($name);
            if (!Image::where('name', $name)->exists()) {
                $path = Storage::disk('public_uploads')->putFileAs('images', $file, $name);
                $image->name = $name;
            } else {
                $path = Storage::disk('public_uploads')->put('images', $file);
                $image->name = mb_substr($path, 7);
            }
            $image->path = 'uploads/' . $path;
            $image->save();
        }
        return response()->json(['success' => true]);
    }
    public function download($imageId)
    {
        $image = Image::find($imageId);
        $zip = new ZipArchive;
        $nameZip = 'uploads/archive.zip';
        if ($zip->open($nameZip, ZipArchive::OVERWRITE | ZipArchive::CREATE) !== true) {
            exit('errors');
        }

        $zip->addFile($image->path, $image->name);
        $zip->close();
        return response()->download($nameZip);
    }
    public function findImage($imageId)
    {

        return response()->json(['success' => true, 'data' => Image::find($imageId)]);
    }
    public function getImagesInfo(Request $request)
    {
        $request->validate([
            "sort" => ['string', 'max:255'],
        ]);

        $images = match ($request->sort) {
            'created_at' => Image::orderBy('created_at', 'ASC')->paginate(6),
            'name' => Image::orderBy('name')->paginate(6),
            '-name' => Image::orderBy('name', 'DESC')->paginate(6),
            default => Image::orderBy('created_at', 'DESC')->paginate(6),
        };

        $images->appends(['sort' => $request->sort])->links();

        return response()->json(['success' => true, 'data' => $images]);
    }
    public function transliterate($st)
    {
        $st = strtr(
            $st,
            array(
                'а' => 'a',
                'б' => 'b',
                'в' => 'v',
                'г' => 'g',
                'д' => 'd',
                'е' => 'e',
                'ё' => 'e',
                'ж' => 'zh',
                'з' => 'z',
                'и' => 'i',
                'й' => 'y',
                'к' => 'k',
                'л' => 'l',
                'м' => 'm',
                'н' => 'n',
                'о' => 'o',
                'п' => 'p',
                'р' => 'r',
                'с' => 's',
                'т' => 't',
                'у' => 'u',
                'ф' => 'f',
                'х' => 'h',
                'ц' => 'c',
                'ч' => 'ch',
                'ш' => 'sh',
                'щ' => 'sch',
                'ь' => '\'',
                'ы' => 'y',
                'ъ' => '\'',
                'э' => 'e',
                'ю' => 'yu',
                'я' => 'ya',

                'А' => 'A',
                'Б' => 'B',
                'В' => 'V',
                'Г' => 'G',
                'Д' => 'D',
                'Е' => 'E',
                'Ё' => 'E',
                'Ж' => 'Zh',
                'З' => 'Z',
                'И' => 'I',
                'Й' => 'Y',
                'К' => 'K',
                'Л' => 'L',
                'М' => 'M',
                'Н' => 'N',
                'О' => 'O',
                'П' => 'P',
                'Р' => 'R',
                'С' => 'S',
                'Т' => 'T',
                'У' => 'U',
                'Ф' => 'F',
                'Х' => 'H',
                'Ц' => 'C',
                'Ч' => 'Ch',
                'Ш' => 'Sh',
                'Щ' => 'Sch',
                'Ь' => '\'',
                'Ы' => 'Y',
                'Ъ' => '\'',
                'Э' => 'E',
                'Ю' => 'Yu',
                'Я' => 'Ya',
            )
        );
        return $st;
    }
}
