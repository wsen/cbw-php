<?php
    include 'includes/my_functions.php';
    $h1;$h2;$p;
    if(isset($_GET['pid'])){
        $pid =  $_GET['pid'];
    } else {
        $pid = 1;
    }
    $content = get_page_cont($pid);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP CMS</title>
		<meta charset="utf-8" />
		<link href="../styles/global_php_style.css" type="text/css" rel="stylesheet" media="screen" />
        <script src="../../script/jquery-3.3.1.min.js"></script>
		<!-- <script src="http://10.10.56.134/script/jquery-3.3.1.min.js"></script> -->

		<style>
            [contenteditable="true"] { background-color: silver; }
		</style>
	</head>
	
	<body>
        <div style="display:none;">
            <input type="hidden" id="pid" value="<?php echo $pid; ?>" />
        </div>
		<div id="wrapper">
            <header>Hier Header mit Logo, Slogan etc.</header>
            <nav>
                <ul>
                    <?php echo get_navi(); ?>
                </ul>
            </nav>
            <main>
                <h1 class="toEdit" name="h1"><?php echo $content['h1']; ?></h1>
                <article>
                    <h2 class="toEdit" name="h2"><?php echo $content['h2']; ?></h2>
                    <p class="toEdit"name="p"><?php echo $content['p']; ?></p>
                </article>
                <!-- <article>
                    <h2></h2>
                    
                </article> -->
                <footer></footer>
            </main>
        </div>
        <script>
            //function korrektur(){};

            $(".toEdit").on("click", function(){
                $(this).attr("contenteditable","false");
                $(this).attr("contenteditable","true");
                $(this).focus();
            });

            $(".toEdit").on("blur", function(){
                //korrektur();
                // console.log($(this).html());

                //AJAX Daten an PHP                             //elem: $(this).attr('name') // $(this).name
                $.post("save_content.php",{ pid: $("#pid").val(), elem: $(this).attr('name'), inhalt: $(this).html() }, 
                function(data, status){
                    console.log(data + " : " + status);
                })
                $(this).removeAttr("contenteditable");
                //$(this).attr("contenteditable","false");;
            });
		</script>
	</body>
</html>
