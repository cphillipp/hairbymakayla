<?php $search_text = empty($_GET['s']) ? __("Search our site","spatreats") : get_search_query(); ?> 
<form method="get" id="searchform" action="<?php echo home_url();?>">
	<fieldset>
    <input id="s" name="s" type="text" 
         	value="<?php echo $search_text;?>" class="text_input"
		    onblur="if(this.value==''){this.value='<?php echo $search_text;?>';}"
            onfocus="if(this.value =='<?php echo $search_text;?>') {this.value=''; }" />
	<input name="submit" type="submit" class="button" value="" />
    </fieldset>
</form>