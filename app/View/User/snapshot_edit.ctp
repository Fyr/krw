<?
    $this->Html->script(array(
        'vendor/jquery/jquery-ui-1.10.3.custom.min',
        'vendor/jquery/jquery.iframe-transport',
        'vendor/jquery/jquery.fileupload',
        'vendor/tmpl.min',
        '/Table/js/format',
        '/Core/js/json_handler',
        'snapshot'
    ), array('inline' => false));

    $uploadURL = $this->Html->url(array('plugin' => 'media', 'controller' => 'ajax', 'action' => 'upload'));
    $processURL = $this->Html->url(array('plugin' => '', 'controller' => 'user', 'action' => 'processImages')).'.json';
    $saveURL = $this->Html->url(array('plugin' => '', 'controller' => 'user', 'action' => 'snapshotSave')).'.json';

    echo $this->Html->tag('p', __('Your snapshot has been saved'), array('class' => 'mandatory on-save', 'style' => 'display: none'));

    echo $this->Form->create();
    echo $this->Html->tag('h2', __('Create a Snapshot'));
    echo $this->form->input('file', array(
        'type' => 'file', 'name' => 'files[]', 'id' => 'fileupload',
        'label' => array('text' => 'Select image(s)'),
        'multiple' => true
    ));
    // echo $this->Form->submit('Create');
    // echo $this->Html->link('Start', 'javascript:;', array('class' => 'button', 'onclick' => 'onProcess'));
    echo $this->Form->end();
?>
<style>
    #table-stats td {
        font-size: 12px;
        padding: 1px 3px;
        font-family: "Courier",  monospace;
    }
    td#preview { padding: 0;}
    .text-right { text-align: right }
</style>
<div id="progress" style="display: none;">
    <span></span>
    <div class="progress progress-striped">
        <div class="bar" style=""></div>
    </div>
</div>

<div id="initOCR" style="display: none">
    <div style="text-align: center">
        <img src="/img/next.png" alt="" style="float: left; height: 40px;"/>
        <?=$this->Html->link('Recognize', 'javascript:;', array('class' => 'button', 'onclick' => 'onRecognize()'))?>
    </div>
</div>

<div id="saveForm" style="display: none">
    <!-- b>Recognition stats:</b> <span id="ocr-stats"></span> <br/-->
    <div style="text-align: center">
        <?=$this->Html->link('Save', 'javascript:;', array('class' => 'button', 'onclick' => 'onSave()'))?>
    </div>
</div>

<table id="stats" border="0" cellpadding="0" cellspacing="0" width="100%" style="display: none;">
    <tbody>
    <tr>
        <td id="preview" width="35%" style="text-align: center; vertical-align: top">
        </td>
        <td id="table-stats" width="65%" style="vertical-align: middle">
        </td>
    </tr>
    </tbody>
</table>
<script type="text/x-tmpl" id="x-table-stats">
{%
	console.log('render table', o.rowset);
%}
<table class="grid" border="0" cellpadding="0" cellspacing="0">
<thead>
	<th>N</th>
	<th>Name</th>
	<th>Lvl</th>
	<th>Rank</th>
	<th>Idle</th>
	<th>XP</th>
	<th>Score</th>
	<th>Status</th>
</thead>
<tbody>
{%
	for(var i = 0; i < o.rowset.length; i++) {
		var row = o.rowset[i].data;
		var icon = (o.rowset[i].status == 'OK') ? 'checked.png' : 'error.png';
%}
<tr data-row="{%=i%}">
	<td align="right">{%=(i + 1)%}</td>
	<td data-col="{%=COL_NAME%}">{%=row[0]%}</td>
	<td align="center" data-col="1">{%=row[1]%}</td>
	<td align="center" data-col="2">{%=row[2]%}</td>
	<td align="center" data-col="3">{%=row[3]%}</td>
	{%#renderNumericCell(i, COL_GXP)%}
	{%#renderNumericCell(i, COL_GS)%}
	<td align="center" data-col="{%=COL_STATUS%}"> <img src="/img/{%=icon%}" alt=""/> </td>
<tr>
{%
	}
%}
</tbody>
</table>

</script>

<script>
function setProgress(percent) {
    $('.progress .bar').css('width', percent + '%');
}

function setMessage(msg) {
    $('#progress span').html(msg);
}

function onSave() {
    $('.on-save').show();
    setProgress(50);
    setMessage('Saving data...');
    let data = {
        id: snapshot_id ? snapshot_id : null,
        ocr_data: ocrData,
        data: aTable,
        img_file: snapshotFile
    };
    $.post('<?=$saveURL?>', {data: data}, function(response){
        console.log(response);
        if (checkJson(response)) {
            snapshot_id = response.data.id;
            setProgress(100);
            setMessage('&nbsp;');
            $('.on-save').show();
        }
    });
}

var ocrData, snapshotFile, snapshot_id;
function onRecognize() {
    setProgress(50);
    setMessage('Recognizing data on image...');
    var url = 'http://' + window.location.href.split('/')[2] + '/files/user/' + snapshotFile;
    ocrSendRequest(url)
        .then(function(response){
            ocrData = response;
            aTable = parseResponseText(response.ParsedResults[0].ParsedText);
            renderTable(aTable);

            var h = $('#table-stats table > thead').height() + 3;
            $('#preview').css('padding-top', h + 'px');
            h = $('#table-stats table > tbody').height() + 3;
            $('#preview img').css('height', h + 'px');

            var errors = 0;
            aTable.forEach(function(e) {
                if (e.status == 'ERROR') {
                    errors++;
                }
            });
            setProgress(100);
            setMessage(`Recognizing data completed: ${aTable.length} rows (${errors} errors) in ${response.ProcessingTimeInMilliseconds} ms`);
            $('#saveForm').show();
        })
        .catch(function (e) {
            console.log(e);
            alert('OCR Error!');
        });
    /*
    $.get('/ocr1.json', null, function(response){
        ocrData = response;
        aTable = parseResponseText(response.ParsedResults[0].ParsedText);
        renderTable(aTable);

        var h = $('#table-stats table > thead').height() + 3;
        $('#preview').css('padding-top', h + 'px');
        h = $('#table-stats table > tbody').height() + 3;
        $('#preview img').css('height', h + 'px');

        var errors = 0;
        aTable.forEach(function(e) {
            if (e.status == 'ERROR') {
                errors++;
            }
        });
        setProgress(100);
        setMessage(`Recognizing data completed: ${aTable.length} rows (${errors} errors) in ${response.ProcessingTimeInMilliseconds} ms`);
        $('#saveForm').show();
    }, 'json');
    */

}

$(function () {
/*
    $('#preview').html(Format.img('/files/user/19dad6c5e7186bdb9eb7ac36ee01ec55.jpg'));
    $('#stats').show();
    */
    // onRecognize();

    console.log(encodeURIComponent('http://krwiki.net/files/user/85bbf1cb3c88ae15bae34b3f77d9ff9e.jpg'));
    $('#fileupload').fileupload({
        url: '<?=$uploadURL?>',
        dataType: 'json',
        singleFileUploads: false,
        start: function() {
            setMessage('Uploading images...');
            $('#progress').show();
            $('#stats').hide();
            $('#saveForm').hide();
            $('.on-save').hide();
        },
        done: function (e, data) {
            var files = data.files.map(e => { return e.name});
            setProgress(75);
            setMessage('Processing images...');
            $.post('<?=$processURL?>', {data: files}, function(response){
                if (checkJson(response)) {
                    snapshotFile = response.data.file;
                    $('#preview').html(Format.img('/files/user/' + snapshotFile));
                    $('#table-stats').html($('#initOCR').html());
                    setProgress(100);
                    setMessage('Processing images completed');
                    setTimeout(function(){ $('#stats').show(); }, 100);
                }
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100 / 2, 10);
            setProgress(progress);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

</script>