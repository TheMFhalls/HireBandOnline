function hideRequired($el){
    $el.find("[required]")
        .removeAttr("required")
        .attr("data-required", true);
}

function showRequired($el){
    $el.find("[data-required]")
        .removeAttr("data-required")
        .attr("required", true);
}

function buscarGenericoJson(data, $select) {
    var selected = $select.attr("data-selected");

    $select.find("option").remove();
    $select.append("<option value=''>-- Selecione --</option>");
    $.each(data, function () {
        if (this.id == selected) {
            $select.append("<option value='"+this.id+"' selected>"+this.nome+"</option>");
        } else {
            $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
        }
    });
}

function buscarEstadosJson(){
    estadosJson(function(data){
        buscarGenericoJson(data, $("select#estado"));
    });
}

function buscarCidadesJson(id){
    cidadesJson(id, function(data){
        buscarGenericoJson(data, $("select#cidade"));
    });
}

function buscarBairrosJson(id){
    bairrosJson(id, function(data){
        buscarGenericoJson(data, $("select#bairro"));
    });
}

function estadosJson(done){
    if(!done){
        done = function(data){
            $select = $("select#estado");

            $select.find("option").remove();
            $select.append("<option value=''>-- Selecione seu Estado --</option>");
            $.each(data, function(){
                $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
            });
        }
    }

    $.ajax({
        url: "/json/estados/lista",
        beforeSend: function(){
            $("section.ajax").removeClass("hide");
            $("select#estado").find("option").remove();
            $("select#cidade").find("option").remove();
            $("select#bairro").find("option").remove();
        },
        complete: function(){
            $("section.ajax").addClass("hide");
        }
    }).done(function(data){
        done(data);
    }).fail(function(){
        alert("Erro ao buscar pelos estados!");
    });
}

function cidadesJson(id, done){
    if(!done){
        done = function(data){
            $select = $("select#cidade");

            $select.find("option").remove();
            $select.append("<option value=''>-- Selecione sua Cidade --</option>");
            $.each(data, function(){
                $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
            });
        }
    }

    $.ajax({
        url: "/json/estado/"+id+"/cidades",
        beforeSend: function(){
            $("section.ajax").removeClass("hide");
            $("select#cidade").find("option").remove();
            $("select#bairro").find("option").remove();
        },
        complete: function(){
            $("section.ajax").addClass("hide");
        }
    }).done(function(data){
        done(data);
    }).fail(function(){
        // alert("Erro ao buscar pelas cidades!");
        alert("Não existem Cidades cadastradas para este Estado!");
    });
}

function bairrosJson(id, done){
    if(!done){
        done = function(data){
            $select = $("select#bairro");

            $select.find("option").remove();
            $select.append("<option value=''>-- Selecione seu Bairro --</option>");
            $.each(data, function(){
                $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
            });
        }
    }

    $.ajax({
        url: "/json/cidade/"+id+"/bairros",
        beforeSend: function(){
            $("section.ajax").removeClass("hide");
            $("select#bairro").find("option").remove();
        },
        complete: function(){
            $("section.ajax").addClass("hide");
        }
    }).done(function(data){
        done(data);
    }).fail(function(){
        // alert("Erro ao buscar pelos bairros!");
        alert("Não existem Bairros cadastradas para esta Cidade!");
    });
}

function categoriasJson(){
    $.ajax({
        url: "/json/categorias",
        beforeSend: function(){
            $("section.ajax").removeClass("hide");
            $("select#bairro").find("option").remove();
        },
        complete: function(){
            $("section.ajax").addClass("hide");
        }
    }).done(function(data){
        $select = $("select#categorias");

        $.each(data, function(){
            $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
        });
    }).fail(function(){
        alert("Erro ao buscar pelas categorias!");
    });
}

function buscarCategoriasJson(){
    $.ajax({
        url: "/json/categorias",
        beforeSend: function(){
            $("section.ajax").removeClass("hide");
        },
        complete: function(){
            $("section.ajax").addClass("hide");
        }
    }).done(function(data){
        var $select = $("select#categoria");
        var selected = $select.attr("data-selected");

        $select.append("<option value=''>-- Selecione --</option>");
        $.each(data, function(){
            if(this.id == selected){
                $select.append("<option value='"+this.id+"' selected>"+this.nome+"</option>");
            }else{
                $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
            }
        });
    }).fail(function(){
        alert("Erro ao buscar pelas categorias!");
    });
}

$(document).ready(function(){

});