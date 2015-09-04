<html>
<head>
<title>TEST</title>
</head>
<body>
<script>  
$('[data-target-form]').on('click', function(){
    var $btn = $(this);
    var $form = $($btn.data('target-form')),
        action = $btn.data('form-action');
    
    $form.attr('action', action);
    $form.submit();
});
</script>  

<form id="postform" class="form-inline"></form>
<div class="btn-group">
    <button type="button" class="btn" 
        data-target-form="#postform" data-form-action="/cart/buynow/103502101">Test 1</button>
    <button type="button" class="btn" 
        data-target-form="#postform" data-form-action="/cart/buynow/103502101">Test 2</button>
    <button type="button" class="btn" 
        data-target-form="#postform" data-form-action="/cart/buynow/103502101">Test 3</button>
</div>
</body>
</html>