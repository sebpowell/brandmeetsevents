jQuery(document).ready(function() {
    
    jQuery('select.page').change(function() {
        
        var no_need_for_text;
        
        if(jQuery(this).hasClass('hide-text')) {
            var no_need_for_text = true;
        }
        jQuery('.banner_area').fadeOut();
        var page_id = jQuery(this).val();
        
        var get_html = "get_new_page=true&page_id="+page_id;
        jQuery.ajax({  
            type: "GET",  
            url: location.href,
            data: get_html,  
            success: function(html) {             
                jQuery('.banner_area').fadeIn().html(html);
                if(no_need_for_text===true) {
                    jQuery('.banner_only_text').hide();
                }
                jQuery('select.page option:first-child').attr("selected", "selected");     
                // Media Upload
                jQuery('#upload_image_button').click(function() {
                    formfield = jQuery('#upload_image').attr('name');
                    tb_show('', 'media-upload.php?type=image&TB_iframe=true');
                    return false;
                });
                window.send_to_editor = function(html) {
                    imgurl = jQuery('img',html).attr('src');
                    jQuery('#upload_image').val(imgurl);
                    tb_remove();
                };    
                
                // Sortable
                jQuery( "#sortable" ).sortable({
                    update : function() {
                        var order = jQuery("#sortable").sortable('serialize');
                        var url =  location.href+"&update_order=true&"+order;
                        jQuery.get(url);
                    }
                });

                
                jQuery('#save_banner').click(function() {
                    var image_url = jQuery('#upload_image').val();
                    var page_id = jQuery('#page_id').val();
                    var new_item = "add_new_banner=true&page_id="+page_id+"&image_path="+image_url;
                    jQuery.ajax({
                        type: "GET",  
                        url: location.href,
                        data: new_item,  
                        success: function(response) {      
                            var last_in_list = jQuery('ul#sortable li').last().attr('id');
                            last_in_list = last_in_list.replace(/\D/g,'');
                            last_in_list = parseFloat(last_in_list) + parseFloat(1);
                            jQuery('ul#sortable').append("<li id='listItem_"+last_in_list+"'><table class='bdy'><form method='post' action=''><tr><td valign='top'><img width='250px' height='auto' src='"+image_url+"' alt='' /></td><td class='banner_only_text' width='250px' valign='top'><textarea class='banner_bigtext'></textarea></td><td class='banner_only_text' width='250px' valign='top'><textarea class='banner_smalltext'></textarea></td><td  width='100px'><button name='delete_banner' class='delete_banner' value='"+last_in_list+"'>Delete</button><button class='banner_only_text' name='update_banner_text' class='update_banner_text' value='"+last_in_list+"'>Update Text</button></td></tr></form></table></li>"); 
                            if(no_need_for_text===true) {
                                jQuery('.banner_only_text').hide();
                            }                       
                        }                      
                    });
                }); 
                
                jQuery('.update_banner_text').live("click", function(event) {

                        var id = jQuery(this).val();
                        var bigtext = jQuery(this).parent().prevAll(":has(.banner_bigtext):first").children().val();
                        var smalltext = jQuery(this).parent().prevAll(":has(.banner_smalltext):first").children().val();
                        var link = jQuery(this).parent().prevAll(":has(.banner_link):first").children().val();                        
                        var update_item = "update_banner_text=true&banner_id="+id+"&bigtext="+bigtext+"&smalltext="+smalltext+"&link="+link;
                        jQuery.ajax({
                            type: "GET",  
                            url: location.href,
                            data: update_item,  
                            success: function() {     
                                alert('Update Successful');
                            }
                        });

                });
            
                jQuery('.delete_banner').live("click",  function(event) {

                        var id = jQuery(this).val();
                        var delete_item = "delete_banner="+id;
                        jQuery.ajax({
                            type: "GET",
                            url: location.href,
                            data: delete_item,
                            success: function() {
                                jQuery("li#listItem_"+id).remove();
                            }
                        });
                });
            
            }  
        });  
    });

});

