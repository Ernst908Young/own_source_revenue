<style>
.mycolor{
   background-color:burlywood
}

</style>
<script>

$(document).ready(function(){
  
    var showOninput= function()
    {
        var oldid= this.oldid
        var target=this.targetid;
        $("#"+this.id).removeClass("mycolor")
        $("#"+target).hide();
        $("#label_"+target).hide();
        $("#"+this.id).on("input",function(){ 
            $("#"+oldid).removeClass("mycolor")
            $("#"+this.id).addClass("mycolor")
            $("#"+target).show();//UK-FCL-00002_0
            $("#label_"+target).show();
          })
          
    }
    showOninput.call({"id":"UK-FCL-00080_0","targetid":"UK-FCL-00002_0"})
    showOninput.call({"id":"UK-FCL-00002_0","targetid":"UK-FCL-00003_0","oldid":"UK-FCL-00080_0"})
    showOninput.call({"id":"UK-FCL-00003_0","targetid":"UK-FCL-00004_0","oldid":"UK-FCL-00002_0"})
    showOninput.call({"id":"UK-FCL-00004_0","oldid":"UK-FCL-00003_0"})
})
</script>