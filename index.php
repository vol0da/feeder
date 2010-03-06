<!DOCTYPE html>
<html>
<head>
  <title>Feeder usage example</title>
  
  <link rel="stylesheet" href="main.css" type="text/css" media="screen" title="feeder usage example" charset="utf-8">
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7/jquery-ui.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
    	var $dialog = $("#feed_popup")
    		.dialog({
    			autoOpen: false,
    			modal: true,
    			closeOnEscape: true,
  				height:400,
  				width:980,
  				position: ['center','center'],
  				show: 'scale',
    			title: 'Basic Dialog'
    		});

    	$("a[id|=open_feed]").click(function() {
    	  feed_id = $(this).attr('id').split('-')[1];
        
        $.ajax({
          method: "get", url: "feeder.ajax.php",data: "feed_id="+feed_id,
          beforeSend: function(){$("#feed_popup").html('').dialog('open');}, 
          success: function(html){
            $("#feed_popup").html(html);
          }
        });
        
        return false; 
    	});
    });
  </script>
</head>
<body>

<a href="#" id="open_feed-1">open feed popup 1</a><br>
<a href="#" id="open_feed-2">open feed popup 2</a><br>
<a href="#" id="open_feed-3">open feed popup 3</a><br>

<div id="feed_popup">
  <img src="" />
</div>


</body>
</html>
