<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ConvertApi\ConvertApi;
use PhpOffice\PhpWord\TemplateProcessor;
use Gotenberg\Gotenberg;
use Gotenberg\Stream;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('replace');
});

Route::post('/', function (Request $request) {
    $file = $request->file('file_doc');
    $file->move(
        public_path('/uploads'),
        $file->getClientOriginalName()
    );
    //get file
    $pathFile = public_path('/uploads/' . $file->getClientOriginalName());

    $phpword = new TemplateProcessor($pathFile);

    $phpword->setMacroChars('{', '}');
    // Replace placeholder text
    $phpword->setValue($request->old_text, $request->new_text);
    // Save the modified Word document
    $phpword->saveAs(public_path('/doc/output.docx'));

    $getPathFileReplace = public_path('/doc/output.docx');

    $downloadFile = null;
    if ($request->render_method == 'old') {
        ConvertApi::setApiSecret(config('convertapi.secret'));
        $result = ConvertApi::convert(
            'pdf',
            [
                'File' => $getPathFileReplace,
            ],
            'docx'
        );
        $result->saveFiles(public_path('/pdf/output.pdf'));
        $downloadFile = public_path('/pdf/output.pdf');
    } else {
        try {
            $request = Gotenberg::libreOffice(config('services.gotenberg.base_url'))
                ->convert(Stream::path($getPathFileReplace));
            $filename = Gotenberg::save($request, public_path('/pdf/'));
            $downloadFile = public_path("/pdf/$filename");
        } catch (\Gotenberg\Exceptions\GotenbergApiErroed $e) {
            return response()->json([
                'trace' =>  $e->getGotenbergTrace(),
            ], 500);
        }
    }

    return response()->download($downloadFile);

});
