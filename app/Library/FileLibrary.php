<?php

namespace App\Library;

class FileLibrary
{
    /**
     * ファイルアップロード処理
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folderPath
     * @param string $option
     *
     * @return array
     */
    public static function uploadFile($file, $folderPath, $option = 'public')
    {
        $fileName = $file->getClientOriginalName();
        $path = \Storage::putFile($folderPath, $file, $option);
        $url  = \Storage::url($path);

        return compact('fileName', 'path', 'url');
    }
   
    // ファイル削除
    public static function deleteFile(string $imageUrl): void
    {
        $path = str_replace('/storage', 'public', $imageUrl);
        \Storage::delete($path);
    }
    
    // CSVファイルをダウンロード
    public function downloadCsv(array $csvHeader, array $csvData, string $fileName): \Illuminate\Http\Response
    {
        // CSVファイルをダウンロード
        $stream = fopen('php://temp', 'w');
        fputcsv($stream, $csvHeader);
        foreach ($csvData as $datum) {
            fputcsv($stream, $datum);
        }
        rewind($stream);
        $csv = stream_get_contents($stream);
        fclose($stream);
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName
        ];
        return \Illuminate\Support\Facades\Response::make($csv, 200, $headers);
    }
}
