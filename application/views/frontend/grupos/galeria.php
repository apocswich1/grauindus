<style>
.lateral{
    width: 400px;
    margin: 5px auto;
}
div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
}

div.gallery:hover {
    border: 1px solid #777;
}

div.gallery img {
    width: 100%;
    height: 150px;
}

div.desc {
    padding: 15px;
    text-align: center;
}

#lightbox {
    position:fixed; /* keeps the lightbox window in the current viewport */
    top:0; 
    left:0; 
    width:100%; 
    height:100%; 
    background:url(overlay.png) repeat; 
    text-align:center;
}

#lightbox p {
    text-align:right; 
    color:#fff; 
    margin-right:20px; 
    font-size:12px; 
}
#lightbox img {
    box-shadow:0 0 25px #111;
    -webkit-box-shadow:0 0 25px #111;
    -moz-box-shadow:0 0 25px #111;
    max-width:940px;
}
#wrapper {
    width:600px; 
    margin:0 auto; /*centers the div horizontally in all browsers (except IE)*/
    background:#fff; 
    text-align:left; /*resets text alignment from body tag */
    border:1px solid #ccc;
    border-top:none; 
    padding:25px; 
    /*Let's add some CSS3 styles, these will degrade gracefully in older browser and IE*/
    border-radius:0 0 5px 5px;
    -moz-border-radius:0 0 5px 5px;
    -webkit-border-radius: 0 0 5px 5px; 
    box-shadow:0 0 5px #ccc;
    -moz-box-shadow:0 0 5px #ccc;
    -webkit-box-shadow:0 0 5px #ccc;
}
</style>
<!--<div id="lightbox">
    <p>Click to close</p>
    <div id="content">
        <img src="#" />
    </div>
</div>-->
<table class="table table-bordered" style="float: center; text-align: center">
<tr>
    <td>
        <div  class="lateral">
    <?php $dataa = $this->cotizaciones_model->getArchivoCotizacionGrupalPorId($id); ?>
    <?php if (sizeof($dataa) > 0) { ?>
        <div class="gallery">
            <a target="_blank" href="<?php echo base_url() . "public/uploadsimg/" . $dataa->archivo; ?>"  class="lightbox_trigger">
                <img  width="200" src="<?php echo base_url() . "public/uploadsimg/" . $dataa->archivo; ?>" alt="Cinque Terre" width="300" height="200">
            </a>
            <div class="desc">Imagen 1</div>
        </div>
        <div class="gallery">
            <a target="_blank" href="<?php echo base_url() . "public/uploadsimg/" . $dataa->archivo2; ?>"  class="lightbox_trigger">
                <img width="200" src="<?php echo base_url() . "public/uploadsimg/" . $dataa->archivo2; ?>" alt="Cinque Terre" width="300" height="200">
            </a>
            <div class="desc">Imagen 2</div>
        </div>
       </div>
<?php } else { ?>
        <p>Image(s) not found.....</p>
    <?php } ?>
</td>    
</tr>    
</table>
<script>
$('.lightbox_trigger').click(function(e) {
		
		e.preventDefault();
		
		var image_href = $(this).attr("href");
		
		/* 	
		If the lightbox window HTML already exists in document, 
		change the img src to to match the href of whatever link was clicked
		
		If the lightbox window HTML doesn't exists, create it and insert it.
		(This will only happen the first time around)
		*/
		
		if ($('#lightbox').length > 0) { // #lightbox exists
			$('#content').html('<img src="' + image_href + '" />');
			$('#lightbox').show();
		}
		
		else { 
			
			var lightbox = 
			'<div id="lightbox" style="z-index:9999">' +
				'<p>Click to close</p>' +
				'<div id="content">' + //insert clicked link's href into img src
					'<img src="' + image_href +'" />' +
				'</div>' +	
			'</div>';
				
			$('body').append(lightbox);
		}
		
	});
	
	$('#lightbox').live('click', function() { 
		$('#lightbox').hide();
	});
</script>