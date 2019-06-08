<div id="preloadImages" style="display: none">
<?
    $aImages = array();
    $aSrc3D = array();
    foreach($aMedia as $media) {
        if (preg_match('/\d{2}\.png/', $media['Media']['orig_fname'])) {
            $src = $this->Media->imageUrl($media, 'noresize');
            $aSrc3D[] = $src;

            // preload images here
?>
    <img src="<?=$src?>" alt="<?=$media['Media']['orig_fname']?>" />
<?
        } else {
            $aImages[] = $media;
        }
    }
?>
</div>
<img src="<?=$aSrc3D[0]?>" alt="" style="width: 100%"/>
<?
    foreach($aImages as $media) {
?>
    <img src="<?= $this->Media->imageUrl($media, 'noresize') ?>" alt="" style="float: left; margin-right: 22px;"/>
<?
    }
?>
<script>
    var i = 0, delay = 150;
    var aSrc = <?=json_encode($aSrc3D)?>;
    function animate() {
        var img = aSrc[i];
        $('.img3D').prop('src', img);
        i++;
        if (i >= aSrc.length) {
            i = 0;
        }
    }

    $(function() {
        setInterval(animate, delay);
    });
</script>
