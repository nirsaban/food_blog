<?php
?>
<?php require_once 'header.php';
require_once 'app/function.php';    
?>

<footer >
<main>
    <hr>
        <section class="section-about">
            <div class="u-section-text u-margin-bottom-8">
            <h2 class="heading-secondary">
            &copy; BY NIR SABAN
            </h2>
        </div>
        </section>
    </main>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

<script>
    
      CKEDITOR.replace( 'title',{
        height: 50 
      });
      CKEDITOR.replace( 'post');
      CKEDITOR.replace( 'how');
      CKEDITOR.replace( 'ingredients');
      CKEDITOR.replace( 'amount',{
          height:50
      });
</script>
</html>

