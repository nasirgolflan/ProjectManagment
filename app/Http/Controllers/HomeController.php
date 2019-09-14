<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function gen(){
        $dir=__DIR__.'/../../';
       $scan=   scandir($dir);
       $models=[];
       
        foreach($scan as $Model){
            if (preg_match("/[A-Z]+[a-zA-z0-9]+.php/", $Model)){
                $class = "\App\\".str_replace('.php','', basename($Model));
                $func = [new $class, 'getFillable'];
                $fillable=$func(); 
                $attribute=$rule=$formHtml=$index='';
                $index="<td>{{\$".strtolower(str_replace('.php','', basename($Model)))."->id}}</td>\n";
                foreach($fillable as $field){
                    $rule.="'".$field."'=>'required',\n";
                    $attribute.="'".$field."' => '".ucwords(str_replace('_',' ',$field))."',\n";
                    $formHtml.=' <div class="form-group">
                    <?= Form::label(\''.$field.'\', \''.ucwords(str_replace('_',' ',$field)).':\') ?>
                    <?= Form::text(\''.$field.'\', isset($model)?$model->'.$field.':\'\' , [\'class\' => $errors->has(\''.$field.'\') ? \'form-control is-invalid\' : \'form-control\'  ]) ?>
                    @error(\''.$field.'\')<div class="alert alert-danger">{{ $message }}</div>@enderror
                </div>'."\n\t";
                    $index.="\t\t\t\t\t\t\t<td>{{\$".strtolower(str_replace('.php','', basename($Model)))."->".$field."}}</td>\n";
                }
                $models[]=[
                    'ClassName'=>str_replace('.php','', basename($Model)),
                    'file'=>$Model,
                    'Class'=>$class,
                    'FolderName'=>strtolower(str_replace('.php','', basename($Model))),
                    'fillable'=>$fillable,
                    'rule'=>$rule,
                    'attribute'=>$attribute,
                    'Formhtml'=>$formHtml,
                    'Indexhtml'=>$index,
                ];
            }
        }

        
        foreach($models as $MODEL){
            //$html
            $htmlCopy=base64_decode('PD9waHAKCm5hbWVzcGFjZSBBcHBcSHR0cFxSZXF1ZXN0czsKCnVzZSBJbGx1bWluYXRlXEZvdW5kYXRpb25cSHR0cFxGb3JtUmVxdWVzdDsKdXNlICFAQ0xBU1NAITsKdXNlIElsbHVtaW5hdGVcVmFsaWRhdGlvblxSdWxlOwoKY2xhc3MgIUBDTEFTU05BTUVAIVJlcXVlc3QgZXh0ZW5kcyBGb3JtUmVxdWVzdAp7CiAgICAvKioKICAgICAqIERldGVybWluZSBpZiB0aGUgdXNlciBpcyBhdXRob3JpemVkIHRvIG1ha2UgdGhpcyByZXF1ZXN0LgogICAgICoKICAgICAqIEByZXR1cm4gYm9vbAogICAgICovCiAgICBwdWJsaWMgZnVuY3Rpb24gYXV0aG9yaXplKCkKICAgIHsKICAgICAgICByZXR1cm4gdHJ1ZTsKICAgIH0KCiAgICAvKioKICAgICAqIEdldCB0aGUgdmFsaWRhdGlvbiBydWxlcyB0aGF0IGFwcGx5IHRvIHRoZSByZXF1ZXN0LgogICAgICoKICAgICAqIEByZXR1cm4gYXJyYXkKICAgICAqLwogICAgcHVibGljIHN0YXRpYyBmdW5jdGlvbiBydWxlcygpCiAgICB7CiAgICAgICAgcmV0dXJuIFsKICAgICAgICAgICAgIUBSVUxFQCEKICAgICAgICBdOwogICAgfQoKCiAgIAoKcHVibGljIGZ1bmN0aW9uIG1lc3NhZ2VzKCkKewogCSAgIHJldHVybiBbCiAgICAgICAgLy8nZmlyc3RfbmFtZS5yZXF1aXJlZCcgPT4gJ0EgZmlyc3QgbmFtZSBpcyByZXF1aXJlZCBieSBtZXNzYWdlJywKICAgICAgICAvLydlbWFpbC5lbWFpbCc9PidpbnZhbGlkIGVtYWlsJwogICAgXTsKfQoKcHVibGljIGZ1bmN0aW9uIGF0dHJpYnV0ZXMoKQp7CiAgICByZXR1cm4gWwogICAgICAgICFAQVRUUlVCVVRFQCEKICAgIF07Cn0KCiAgCn0K');
            
            //$ControllerHtmlCopy=$ControllerHtml;
            //echo base64_encode($ControllerHtmlCopy);exit;
            $ControllerHtmlCopy=base64_decode('PD9waHAKLy9waHAgYXJ0aXNhbiBtYWtlOm1vZGVsICFAQ0xBU1NOQU1FQCEgLS1taWdyYXRpb24KLyoqCiAqIHBocCBhcnRpc2FuIG1pZ3JhdGUKICogcGhwIGFydGlzYW4gbWFrZTpjb250cm9sbGVyICFAQ0xBU1NOQU1FQCFDb250cm9sbGVyIC0tcmVzb3VyY2UKICogCiAqIHJvdXRlcy93ZWIucGhwIAogKiBSb3V0ZTo6cmVzb3VyY2UoJyFARk9MREVSTkFNRUAhJywgJyFAQ0xBU1NOQU1FQCFDb250cm9sbGVyJyk7CiAqIFJvdXRlOjphcGlSZXNvdXJjZSgnIUBGT0xERVJOQU1FQCEnLCAnIUBDTEFTU05BTUVAIUNvbnRyb2xsZXInKTsKICovCm5hbWVzcGFjZSBBcHBcSHR0cFxDb250cm9sbGVyczsKCnVzZSBJbGx1bWluYXRlXEh0dHBcUmVxdWVzdDsKdXNlIElsbHVtaW5hdGVcU3VwcG9ydFxGYWNhZGVzXERCOwp1c2UgIUBDTEFTU0AhOwp1c2UgQXBwXEh0dHBcUmVxdWVzdHNcIUBDTEFTU05BTUVAIVJlcXVlc3Q7CgoKY2xhc3MgIUBDTEFTU05BTUVAIUNvbnRyb2xsZXIgZXh0ZW5kcyBDb250cm9sbGVyCnsKICAgIC8qKgogICAgICogRGlzcGxheSBhIGxpc3Rpbmcgb2YgdGhlIHJlc291cmNlLgogICAgICoKICAgICAqIEByZXR1cm4gXElsbHVtaW5hdGVcSHR0cFxSZXNwb25zZQogICAgICovCiAgICAKICAgIHB1YmxpYyBmdW5jdGlvbiBfX2NvbnN0cnVjdCgpCiAgICB7CiAgICAgICAgJHRoaXMtPm1pZGRsZXdhcmUoJ2F1dGgnKTsKICAgIH0KICAgICAgICAKICAgIHB1YmxpYyBmdW5jdGlvbiBpbmRleChSZXF1ZXN0ICRyZXF1ZXN0KQogICAgewogICAgLy8gICAgICRuYW1lID0gJHJlcXVlc3QtPmdldCgnZmlyc3RfbmFtZScpIT0nJz8kcmVxdWVzdC0+Z2V0KCdmaXJzdF9uYW1lJyk6ZmFsc2U7CiAgICAvLyAgICAgJGVtYWlsID0gJHJlcXVlc3QtPmdldCgnZW1haWwnKSE9Jyc/JHJlcXVlc3QtPmdldCgnZW1haWwnKTpmYWxzZTsKICAgIC8vICAgICAkam9iX3RpdGxlID0gJHJlcXVlc3QtPmdldCgnam9iX3RpdGxlJykhPScnPyRyZXF1ZXN0LT5nZXQoJ2pvYl90aXRsZScpOmZhbHNlOwogICAgLy8gICAgICRjaXR5ID0gJHJlcXVlc3QtPmdldCgnY2l0eScpIT0nJz8kcmVxdWVzdC0+Z2V0KCdjaXR5Jyk6ZmFsc2U7CiAgICAvLyAgICAgJGNvdW50cnkgPSAkcmVxdWVzdC0+Z2V0KCdjb3VudHJ5JykhPScnPyRyZXF1ZXN0LT5nZXQoJ2NvdW50cnknKTpmYWxzZTsKICAgICAgICAKICAgIC8vICAgICAvLyRnZW5kZXIgPSAkcmVxdWVzdC0+Z2V0KCdnZW5kZXInKSAhPSAnJyA/ICRyZXF1ZXN0LT5nZXQoJ2dlbmRlcicpIDogLTE7CiAgICAvLyAgICAvLyAkZmllbGQgPSAkcmVxdWVzdC0+Z2V0KCdmaWVsZCcpICE9ICcnID8gJHJlcXVlc3QtPmdldCgnZmllbGQnKSA6ICduYW1lJzsKICAgIC8vICAgIC8vICRzb3J0ID0gJHJlcXVlc3QtPmdldCgnc29ydCcpICE9ICcnID8gJHJlcXVlc3QtPmdldCgnc29ydCcpIDogJ2FzYyc7CiAgICAKICAgICAgICAgJG1vZGVsID0gbmV3ICFAQ0xBU1NOQU1FQCEoKTsKICAgIC8vICAgICBpZigkbmFtZSl7CiAgICAvLyAgICAgICAgICRtb2RlbD0kbW9kZWwtPndoZXJlKCdmaXJzdF9uYW1lJywgJ2xpa2UnLCAnJScgLiAkbmFtZSAuICclJyk7CiAgICAvLyAgICAgfQogICAgLy8gICAgIGlmKCRlbWFpbCl7CiAgICAvLyAgICAgICAgICRtb2RlbD0kbW9kZWwtPndoZXJlKCdlbWFpbCcsICdsaWtlJywgJyUnIC4gJGVtYWlsIC4gJyUnKTsKICAgIC8vICAgICB9CiAgICAvLyAgICAgaWYoJGpvYl90aXRsZSl7CiAgICAvLyAgICAgICAgICRtb2RlbD0kbW9kZWwtPndoZXJlKCdqb2JfdGl0bGUnLCAnbGlrZScsICclJyAuICRqb2JfdGl0bGUgLiAnJScpOwogICAgLy8gICAgIH0KICAgIC8vICAgICBpZigkY2l0eSl7CiAgICAvLyAgICAgICAgICRtb2RlbD0kbW9kZWwtPndoZXJlKCdjaXR5JywgJ2xpa2UnLCAnJScgLiAkY2l0eSAuICclJyk7CiAgICAvLyAgICAgfQogICAgLy8gICAgIGlmKCRjb3VudHJ5KXsKICAgIC8vICAgICAgICAgJG1vZGVsPSRtb2RlbC0+d2hlcmUoJ2NvdW50cnknLCAnbGlrZScsICclJyAuICRjb3VudHJ5IC4gJyUnKTsKICAgIC8vICAgICB9CiAgICAgICAgLy8kbW9kZWw9JG1vZGVsLT5zb3J0YWJsZSgpLT5wYWdpbmF0ZSgyKTsKICAgICAgICAkbW9kZWw9JG1vZGVsLT5wYWdpbmF0ZSgyKTsKICAgICAgICByZXR1cm4gdmlldygnIUBGT0xERVJOQU1FQCEuaW5kZXgnLCBjb21wYWN0KCdtb2RlbCcpKTsKICAgIH0KCiAgICAvKioKICAgICAqIFNob3cgdGhlIGZvcm0gZm9yIGNyZWF0aW5nIGEgbmV3IHJlc291cmNlLgogICAgICoKICAgICAqIEByZXR1cm4gXElsbHVtaW5hdGVcSHR0cFxSZXNwb25zZQogICAgICovCiAgICBwdWJsaWMgZnVuY3Rpb24gY3JlYXRlKCkKICAgIHsKICAgICAgICByZXR1cm4gdmlldygnIUBGT0xERVJOQU1FQCEuY3JlYXRlJyk7CiAgICB9CiAgICAKICAgIC8qKgogICAgICogU3RvcmUgYSBuZXdseSBjcmVhdGVkIHJlc291cmNlIGluIHN0b3JhZ2UuCiAgICAgKgogICAgICogQHBhcmFtICBcSWxsdW1pbmF0ZVxIdHRwXFJlcXVlc3QgICRyZXF1ZXN0CiAgICAgKiBAcmV0dXJuIFxJbGx1bWluYXRlXEh0dHBcUmVzcG9uc2UKICAgICAqLwogICAgCiAgICBwdWJsaWMgZnVuY3Rpb24gc3RvcmUoIUBDTEFTU05BTUVAIVJlcXVlc3QgJHJlcXVlc3QpCiAgICB7CiAgICAgICAgJHZhbGlkYXRlZERhdGEgPSAkcmVxdWVzdC0+dmFsaWRhdGVkKCk7CgogICAgICAgICRtb2RlbCA9IG5ldyAhQENMQVNTTkFNRUAhOwogICAgICAgIC8vJGRhdGEgPSAkcmVxdWVzdC0+b25seSgkbW9kZWwtPmdldEZpbGxhYmxlKCkpOwogICAgICAgICRkYXRhID0gJHJlcXVlc3QtPmFsbCgpOwogICAgICAgICRtb2RlbC0+ZmlsbCgkZGF0YSktPnNhdmUoKTsKICAgICAgICByZXR1cm4gcmVkaXJlY3QoJy8hQEZPTERFUk5BTUVAIScpLT53aXRoKCdzdWNjZXNzJywgJyFAQ0xBU1NOQU1FQCEgc2F2ZWQhJyk7CiAgICB9CgogICAgCgogICAgLyoqCiAgICAgKiBEaXNwbGF5IHRoZSBzcGVjaWZpZWQgcmVzb3VyY2UuCiAgICAgKgogICAgICogQHBhcmFtICBpbnQgICRpZAogICAgICogQHJldHVybiBcSWxsdW1pbmF0ZVxIdHRwXFJlc3BvbnNlCiAgICAgKi8KICAgIHB1YmxpYyBmdW5jdGlvbiBzaG93KGludCAkaWQpCiAgICB7CiAgICAgICAgLy8KICAgIH0KCiAgICAvKioKICAgICAqIFNob3cgdGhlIGZvcm0gZm9yIGVkaXRpbmcgdGhlIHNwZWNpZmllZCByZXNvdXJjZS4KICAgICAqCiAgICAgKiBAcGFyYW0gIGludCAgJGlkCiAgICAgKiBAcmV0dXJuIFxJbGx1bWluYXRlXEh0dHBcUmVzcG9uc2UKICAgICAqLwogICAgcHVibGljIGZ1bmN0aW9uIGVkaXQoaW50ICRpZCkKICAgIHsKICAgICAgICAkbW9kZWwgPSAhQENMQVNTTkFNRUAhOjpmaW5kKCRpZCk7CiAgICAgICAgcmV0dXJuIHZpZXcoJyFARk9MREVSTkFNRUAhLmVkaXQnLCBjb21wYWN0KCdtb2RlbCcpKTsgICAgCiAgICB9CiAgICAgICAgCiAgICAvKioKICAgICAqIFVwZGF0ZSB0aGUgc3BlY2lmaWVkIHJlc291cmNlIGluIHN0b3JhZ2UuCiAgICAgKgogICAgICogQHBhcmFtICBcSWxsdW1pbmF0ZVxIdHRwXFJlcXVlc3QgICRyZXF1ZXN0CiAgICAgKiBAcGFyYW0gIGludCAgJGlkCiAgICAgKiBAcmV0dXJuIFxJbGx1bWluYXRlXEh0dHBcUmVzcG9uc2UKICAgICAqLwogICAgcHVibGljIGZ1bmN0aW9uIHVwZGF0ZSghQENMQVNTTkFNRUAhUmVxdWVzdCAkcmVxdWVzdCxpbnQgJGlkKQogICAgewogICAgICAgICRyZXF1ZXN0LT52YWxpZGF0ZWQoKTsKICAgICAgICAkbW9kZWwgPSAhQENMQVNTTkFNRUAhOjpmaW5kKCRpZCk7CiAgICAgICAgLy8kZGF0YSA9ICRyZXF1ZXN0LT5vbmx5KCRtb2RlbC0+Z2V0RmlsbGFibGUoKSk7CiAgICAgICAgICRkYXRhID0gJHJlcXVlc3QtPmFsbCgpOwogICAgICAgICAkbW9kZWwtPmZpbGwoJGRhdGEpLT5zYXZlKCk7CiAgICAgICAgcmV0dXJuIHJlZGlyZWN0KCcvIUBGT0xERVJOQU1FQCEnKS0+d2l0aCgnc3VjY2VzcycsICchQENMQVNTTkFNRUAhIHVwZGF0ZWQhJyk7CiAgICB9CgogICAgLyoqCiAgICAgKiBSZW1vdmUgdGhlIHNwZWNpZmllZCByZXNvdXJjZSBmcm9tIHN0b3JhZ2UuCiAgICAgKgogICAgICogQHBhcmFtICBpbnQgICRpZAogICAgICogQHJldHVybiBcSWxsdW1pbmF0ZVxIdHRwXFJlc3BvbnNlCiAgICAgKi8KICAgIHB1YmxpYyBmdW5jdGlvbiBkZXN0cm95KGludCAkaWQpCiAgICB7CiAgICAgICAgJG1vZGVsID0gIUBDTEFTU05BTUVAITo6ZmluZCgkaWQpOwogICAgICAgICRtb2RlbC0+ZGVsZXRlKCk7CgogICAgICAgIHJldHVybiByZWRpcmVjdCgnLyFARk9MREVSTkFNRUAhJyktPndpdGgoJ3N1Y2Nlc3MnLCAnIUBDTEFTU05BTUVAISBkZWxldGVkIScpOwogICAgfQp9Cg==');
            $replce=[
                '!@CLASS@!'=>$MODEL['Class'],
                '!@CLASSNAME@!'=>str_replace('.php','', basename($MODEL['file'])),
                '!@RULE@!'=>$MODEL['rule'],
                '!@ATTRUBUTE@!'=>$MODEL['attribute'],
                '!@FOLDERNAME@!'=>$MODEL['FolderName'],
    
            ];
            foreach($replce as $k=>$v){
                $htmlCopy=str_replace($k,$v,$htmlCopy);
                $ControllerHtmlCopy=str_replace($k,$v,$ControllerHtmlCopy);
            }
            $fileName=str_replace('.php','', basename($MODEL['file'])).'Request.php';
            $ControllerfileName=str_replace('.php','', basename($MODEL['file'])).'Controller.php';
            file_put_contents($dir.'/Http/Requests/'.$fileName,$htmlCopy);
            file_put_contents($dir.'/Http/Controllers/'.$ControllerfileName,$ControllerHtmlCopy);
        }

    //    echo "<pre>";

    //   print_r($models[0]);exit;
       $dir= $dir.'/../resources/views/';
       $Folder='testdir';
       $index='index.blade';
       $create='create.blade';
       $edit='edit.blade';
       $form='form.blade';


       //mkdir($dir.'/'.strtolower($MODEL['ClassName']));
       foreach($models as $MODEL){
       
        $filePath=$dir.'/'.strtolower($MODEL['ClassName']);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
        //$htmlCopy=$formHTML;
         //echo base64_encode($htmlCopy);exit;
         $htmlCopy=base64_decode('PD9waHAgCiAgICAgICAvKioKICAgICAgICAqICFAQ09OVFJPTExFUkAhIEZvcm0KICAgICAgICAqLwogICAgICAgPz4KICAgICAgIEBpZihpc3NldCgkbW9kZWwpKQogICAgICAgICAgIHt7IEZvcm06Om1vZGVsKCRtb2RlbCwgWydyb3V0ZScgPT4gWychQENPTlRST0xMRVJAIS51cGRhdGUnLCAkbW9kZWwtPmlkXSwgJ21ldGhvZCcgPT4gJ3BhdGNoJ10pIH19CiAgICAgICBAZWxzZQogICAgICAgICAgIHt7IEZvcm06Om9wZW4oWydyb3V0ZScgPT4gJyFAQ09OVFJPTExFUkAhLnN0b3JlJ10pIH19CiAgICAgICBAZW5kaWYKCiAgICAgIAogICAgICAgfiFARklFTERTQCF+CiAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICA8YnV0dG9uIHR5cGU9InN1Ym1pdCIgY2xhc3M9ImJ0biBidG4tcHJpbWFyeS1vdXRsaW5lIj57e2lzc2V0KCRtb2RlbCk/J1VwZGF0ZSc6J0FkZCd9fSAhQENPTlRST0xMRVJAITwvYnV0dG9uPgogICAgICAgICAgICAgICA8Pz0gRm9ybTo6Y2xvc2UoKSA/PgogICAgICAg');
        $replce=[
            '~!@FIELDS@!~'=>$MODEL['Formhtml'],
            '!@CONTROLLER@!'=>strtolower($MODEL['ClassName']),
            

        ];
        foreach($replce as $k=>$v){
            $htmlCopy=str_replace($k,$v,$htmlCopy);
        }
        file_put_contents($filePath.'/form.blade.php',$htmlCopy); 
        /****
         * CREATE PAGE
         */
       // $htmlCopyCreate=$createHTML;
       // echo base64_encode($htmlCopyCreate);exit;
        $htmlCopyCreate=base64_decode('QGV4dGVuZHMoJ2xheW91dHMuYXBwJykKCiAgICAgICBAc2VjdGlvbignY29udGVudCcpCiAgICAgICA8ZGl2IGNsYXNzPSJyb3ciPgogICAgICAgIDxkaXYgY2xhc3M9ImNvbC1zbS04IG9mZnNldC1zbS0yIj4KICAgICAgICAgICA8aDEgY2xhc3M9ImRpc3BsYXktMyI+e3tpc3NldCgkbW9kZWwpPydFZGl0JzonQWRkJ319IGEgIUBGT0xERVJAITwvaDE+CiAgICAgICAgIDxkaXY+CiAgICAgICAgCiAgICAgICAgICAgQGluY2x1ZGUoJyFARk9MREVSQCEuZm9ybScpCiAgICAgICAgIDwvZGl2PgogICAgICAgPC9kaXY+CiAgICAgICA8L2Rpdj4KICAgICAgIEBlbmRzZWN0aW9u');

       // $htmlCopyEdit=$editHTML;
       // echo "".base64_encode($htmlCopyEdit);exit;
        $htmlCopyEdit=base64_decode('QGV4dGVuZHMoJ2xheW91dHMuYXBwJykKCiAgICAgICBAc2VjdGlvbignY29udGVudCcpCiAgICAgICA8ZGl2IGNsYXNzPSJyb3ciPgogICAgICAgIDxkaXYgY2xhc3M9ImNvbC1zbS04IG9mZnNldC1zbS0yIj4KICAgICAgICAgICA8aDEgY2xhc3M9ImRpc3BsYXktMyI+IHt7aXNzZXQoJG1vZGVsKT8nRWRpdCc6J0FkZCd9fSBhICFARk9MREVSQCE8L2gxPgogICAgICAgICA8ZGl2PgogICAgICAgIAogICAgICAgICAgIEBpbmNsdWRlKCchQEZPTERFUkAhLmZvcm0nKQogICAgICAgICA8L2Rpdj4KICAgICAgIDwvZGl2PgogICAgICAgPC9kaXY+CiAgICAgICBAZW5kc2VjdGlvbg==');

       // $htmlCopyIndex=$indexHTML;
       // echo base64_encode($htmlCopyIndex);exit;
        $htmlCopyIndex=base64_decode('PD9waHAKCiAgICAgICBGb3JtOjptYWNybygnU2VhcmNoRmllbGQnLCBmdW5jdGlvbigkbmFtZSkKICAgICAgIHsKICAgICAgICAgLy9lY2hvICI8cHJlPiI7cHJpbnRfcigkX0dFVCk7ZXhpdDsKICAgICAgICAgJHZhcj1pc3NldCgkX0dFVFskbmFtZV0pPyRfR0VUWyRuYW1lXToiIjsKICAgICAgICAgJHJldHVybiA9JwogICAgICAgICA8Zm9ybSBtZXRob2Q9ImdldCI+CiAgICAgICAgIDxkaXYgY2xhc3M9ImlucHV0LWdyb3VwIj4nOwogICAgICAgICBpZihpc3NldCgkX0dFVCkpewogICAgICAgICAgIGZvcmVhY2goJF9HRVQgYXMgJGs9PiR2KXsKICAgICAgICAgICAgICRyZXR1cm4gLj0nPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iJy4kay4nIiB2YWx1ZT0iJy4kdi4nIj4nOwogICAgICAgICAgIH0KICAgICAgICAgfQogICAgICAgICAkcmV0dXJuIC49JzxpbnB1dCB0eXBlPSJ0ZXh0IiB2YWx1ZT0iJy4kdmFyLiciIGNsYXNzPSJmb3JtLWNvbnRyb2wiIG5hbWU9IicuJG5hbWUuJyIgcGxhY2Vob2xkZXI9IlNlYXJjaCAnLiRuYW1lLicgIj4gCiAgICAgICAgICAgPC9kaXY+IDwvZm9ybT4nOwogICAgICAgICByZXR1cm4gJHJldHVybjsKICAgICAgIH0pOwogICAgICAgCiAgICAgICA/PgogICAgICAgCiAgICAgICBAZXh0ZW5kcygnbGF5b3V0cy5hcHAnKQogICAgICAgCiAgICAgICBAc2VjdGlvbignY29udGVudCcpCiAgICAgICA8ZGl2IGNsYXNzPSJyb3ciPgogICAgICAgPGRpdiBjbGFzcz0iY29sLXNtLTEyIj4KICAgICAgIEBpZihzZXNzaW9uKCktPmdldCgnc3VjY2VzcycpKQogICAgICAgICAgIDxkaXYgY2xhc3M9ImFsZXJ0IGFsZXJ0LXN1Y2Nlc3MiPgogICAgICAgICAgICAge3sgc2Vzc2lvbigpLT5nZXQoJ3N1Y2Nlc3MnKSB9fSAgCiAgICAgICAgICAgPC9kaXY+CiAgICAgICBAZW5kaWYKICAgICAgIAogICAgICAgPGRpdiBjbGFzcz0iY29udGFpbmVyIj4KICAgICAgIAogICAgICAgPC9kaXY+CiAgICAgICAKICAgICAgICAgICA8aDEgY2xhc3M9ImRpc3BsYXktMyI+IUBGT0xERVJAITwvaDE+ICAKICAgICAgICAgICAgICAgICAgICAgICA8YSBocmVmPSJ7eyByb3V0ZSgnIUBGT0xERVJAIS5jcmVhdGUnKX19IiBjbGFzcz0iYnRuIGJ0bi1wcmltYXJ5Ij5DcmVhdGUgTmV3IFJlY29yZDwvYT4KICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICA8dGFibGUgY2xhc3M9InRhYmxlIHRhYmxlLXN0cmlwZWQiPgogICAgICAgICAgIAogICAgICAgICAgIAogICAgICAgICAgIDx0Ym9keT4KICAgICAgICAgICAgICAgQGZvcmVhY2goJG1vZGVsIGFzICQhQEZPTERFUkAhKQogICAgICAgICAgICAgICA8dHI+CiAgICAgICAgICAgICAgICFASU5ERVhIVE1MQCEKICAgICAgICAgICAgICAgICAgIDx0ZD4KICAgICAgICAgICAgICAgICAgICAgICA8YSBocmVmPSJ7eyByb3V0ZSgnIUBGT0xERVJAIS5lZGl0JywkIUBGT0xERVJAIS0+aWQpfX0iIGNsYXNzPSJidG4gYnRuLXByaW1hcnkiPkVkaXQ8L2E+CiAgICAgICAgICAgICAgICAgICA8L3RkPgogICAgICAgICAgICAgICAgICAgPHRkPgogICAgICAgICAgICAgICAgICAgICAgIDxmb3JtIGFjdGlvbj0ie3sgcm91dGUoJyFARk9MREVSQCEuZGVzdHJveScsICQhQEZPTERFUkAhLT5pZCl9fSIgbWV0aG9kPSJwb3N0Ij4KICAgICAgICAgICAgICAgICAgICAgICAgIEBjc3JmCiAgICAgICAgICAgICAgICAgICAgICAgICBAbWV0aG9kKCdERUxFVEUnKQogICAgICAgICAgICAgICAgICAgICAgICAgPGJ1dHRvbiBjbGFzcz0iYnRuIGJ0bi1kYW5nZXIiIG9uY2xpY2s9InJldHVybiBjb25maXJtKCdBcmUgeW91IHN1cmU/JykiIHR5cGU9InN1Ym1pdCI+RGVsZXRlPC9idXR0b24+CiAgICAgICAgICAgICAgICAgICAgICAgPC9mb3JtPgogICAgICAgICAgICAgICAgICAgPC90ZD4KICAgICAgICAgICAgICAgPC90cj4KICAgICAgICAgICAgICAgQGVuZGZvcmVhY2gKICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICA8L3Rib2R5PgogICAgICAgICA8L3RhYmxlPgogICAgICAgICB7eyAkbW9kZWwtPmxpbmtzKCkgfX0gCiAgICAgICAgCiAgICAgICA8ZGl2PgogICAgICAgPC9kaXY+CiAgICAgICAKICAgICAgIEBlbmRzZWN0aW9uCiAgICAgICAKICAgICAgIA==');
        
        $replce=[
            '!@FOLDER@!'=>strtolower($MODEL['ClassName']),
            '!@INDEXHTML@!'=>$MODEL['Indexhtml'],
        ];
        foreach($replce as $k=>$v){
            $htmlCopyCreate=str_replace($k,$v,$htmlCopyCreate);
            $htmlCopyEdit=str_replace($k,$v,$htmlCopyEdit);
            $htmlCopyIndex=str_replace($k,$v,$htmlCopyIndex);
        }
        file_put_contents($filePath.'/create.blade.php',$htmlCopyCreate); 
        file_put_contents($filePath.'/edit.blade.php',$htmlCopyEdit); 
        file_put_contents($filePath.'/index.blade.php',$htmlCopyIndex); 
        //file_put_contents($dir.'/Http/Requests/'.$fileName,$htmlCopy);
        }

    //    file_put_contents($filePath.'/form.blade',$htmlCopy);
    //    $scan=   scandir($dir);
    //    print_r($scan);
    echo "success";
       exit;
       
       print_r($models);
    }
}
