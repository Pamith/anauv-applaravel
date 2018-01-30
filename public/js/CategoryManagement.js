var i =1;
$('#addChild').click(function(){
	var field = '<label for="childcategory_'+i+'" class="col-md-4 control-label">Children '+i+'</label><div class="col-md-6"><input id="childcategory_'+i+'" type="text" class="form-control" name="childcategory[]" value="" required autofocus></div>'
$('#childrens').append(field);
i++;
});