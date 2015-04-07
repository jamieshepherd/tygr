@if(in_array($attachment->extension, array('jpg','jpeg','png','gif','tiff','svg')))
    <i class="fa fa-file-image-o"></i>
@elseif(in_array($attachment->extension, array('wav','mp3')))
    <i class="fa fa-file-audio-o"></i>
@elseif(in_array($attachment->extension, array('mov','avi','mp4')))
    <i class="fa fa-file-movie-o"></i>
@elseif(in_array($attachment->extension, array('pdf')))
    <i class="fa fa-file-pdf-o"></i>
@elseif(in_array($attachment->extension, array('zip','rar')))
    <i class="fa fa-file-archive-o"></i>
@elseif(in_array($attachment->extension, array('doc','docx')))
    <i class="fa fa-file-word-o"></i>
@elseif(in_array($attachment->extension, array('xls','xlsx')))
    <i class="fa fa-file-excel-o"></i>
@elseif(in_array($attachment->extension, array('ppt','pptx')))
    <i class="fa fa-file-powerpoint-o"></i>
@elseif(in_array($attachment->extension, array('txt','text')))
    <i class="fa fa-file-text-o"></i>
@else
    <i class="fa fa-file-o"></i>
@endif