//app-id-container
const post_url="./app/index.php";

$(document).ready(function () {
    $(".menus").unbind().click(function () {//dynamic menu function selection
       handleMenuClickFunction(this);
    });
});

function simpleInternalFunctions() {
    'use strict';

    $(".tracksAdd").unbind().click(function () {
        const id=$(this).attr("id")
        const album=new stringManager();

        album.generalTags("<div class='app-left app-white app-round app-padding app-width-60'>");

        album.generalTags("<h3 class='app-left app-border-bottom app-full no-padding' >Create Track</h3>");

        album.generalTags("<div class='app-left form-group app-full ' id='create'>");

        album.generalTags("<label>Track name</label>")

        album.generalTags(`<input type="text" id="name"/>`);

        album.generalTags("</div>");

        album.generalTags("<div class='app-left form-group app-full '>");

        album.generalTags(`<input type='submit' id="submitTrack" value="submit" class='form-control btn btn-primary'/>`);

        album.generalTags("</div>");

        album.generalTags("</div>");

        popWindow(album.toString(),()=>{

            $("#submitTrack").unbind().click(function () {
                $.post(`${post_url}?sq=2`,{ip:2,
                    name:$("#name").val(),id:id},function (data) {
                    //todo : return all of the genres
                    let cont=convertJson(data)
                    if(cont.status==true){
                        $("#album-container").html(cont.content);
                        pop.fadeOut('fast');
                        simpleInternalFunctions();
                    }
                })
            });
        });

    });

    $("#createAlbum").unbind().click(function () {

        const album=new stringManager();

        album.generalTags("<div class='app-left app-white app-round app-padding app-width-60'>");

        album.generalTags("<h3 class='app-left app-border-bottom app-full no-padding' >Create Album</h3>");

        [
            {name:"Album name",id:'alname',type:'text'},
            {name:"Date released",id:'aldate',type:'date'},
        ].forEach(({name,id,type})=>{
            album.generalTags("<div class='app-left form-group app-full '>");

            album.generalTags(`<label class='no-padding app-full app-left'>${name}</label>`);

            album.generalTags(`<input type='${type}' id="${id}" class='form-control'/>`);

            album.generalTags("</div>");
        });
        album.generalTags("<div class='app-left form-group app-full '>");

        album.generalTags(`<label class='no-padding app-full app-left'>Artist</label>`);

        album.generalTags(`<input type='text' id="artist" list="artists" class='form-control'/>`);

        album.generalTags("<datalist id='artists'>");

        album.generalTags("<option value='ambrose'>Ambrose mwangi</option>")

        album.generalTags("</datalist>")

        album.generalTags("</div>");

        album.generalTags("<div class='app-left form-group app-full '>");

        album.generalTags("<label>Select Genre</label>")

        album.generalTags(`<select class="form-control" id="select">`);

        album.generalTags("<option value='1'>Techno Music</option>")

        album.generalTags("</select>")

        album.generalTags("</div>");

        album.generalTags("<div class='app-left form-group app-full '>");

        album.generalTags(`<input type='submit' id="submitAlbum" value="submit" class='form-control btn btn-primary'/>`);

        album.generalTags("</div>");

        album.generalTags("</div>");

      const pop=popWindow(album.toString(),()=>{
          $("#submitAlbum").unbind().click(function () {
             $.post(`${post_url}?sq=2`,{ip:1,
                 date:$("#aldate").val(),
                 name:$("#alname").val(),
                 artist:$("#artist").val(),
                 sel:$("#select").val()},function (data) {
                 //todo : return all of the genres
                 let cont=convertJson(data)
                 if(cont.status==true){
                     $("#album-container").html(cont.content);
                     pop.fadeOut('fast');
                     simpleInternalFunctions();
                 }
             })
          });
       });
    });
}

function handleMenuClickFunction(btn){
    'use strict';
    if($(btn).attr("id")===undefined)
        return

    $.post(`${post_url}?sq=1`,{bt:$(btn).attr('id')},data=> {
        let cont=convertJson(data)
        if(cont.status==true){
           $("#app-id-container").html(cont.content);
           simpleInternalFunctions();
        }
    })



}
function convertJson(data){
    try{
        var ob=$.parseJSON(data);
        if(ob.Content=="LOGGED_OUT"){
            window.location.reload();
        }
        return $.parseJSON(data)
    }catch(e){
        alert(e);
        alert(data);
    }
   /* try{
        const items=JSON.parse(data);

        if(items.status ==false){
            alert(data);
            return 0;
        }
        return items;
    }catch (e) {
        console.log(e)
    }*/

}
function popWindow(cont,callback){
    const pop=$("#popwindow");

    pop.fadeIn('fast',function () {
        $(this).css("display","grid")
        pop.html(cont);
        if(callback !=undefined)
            callback()

        window.onclick=function (e) {
            if(e.target.id=="popwindow"){
                pop.fadeOut('fast')
            }
        }
    });

    return pop;
}

function stringManager(){
    return {
        cont:[],
        generalTags:function (cont) {
            this.cont.push(cont);
        },
        toString:function () {
            return this.cont.join(" ");
        }
    }
}