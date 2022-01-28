<script>
    
        
    $("#checkPermissionAll").change(function() {
        if (this.checked) {
            $(".form-check-input").each(function() {
                this.checked=true;
            });
        } else {
            $(".form-check-input").each(function() {
                this.checked=false;
            });
        }
    });
   

         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
            implementAllChecked();
            
         }

         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);

            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }

         function implementAllChecked() {
             const countPermissions = {{ count($all_permissions) }};
             const countPermissionGroups = {{ count($permission_groups) }};

              /* console.log((countPermissions + countPermissionGroups));
              console.log($('input[type="checkbox"]:checked').length); */

             if($('input[type="checkbox"]:checked').length == (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }


</script>