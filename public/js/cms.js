$(document).ready(function(){
  $(".del").click(function(){
    if (!confirm("确认删除？")){
      return false;
    }
  });
});