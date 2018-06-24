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

function estadosJson(){
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
        $select = $("select#estado");

        $select.find("option").remove();
        $select.append("<option value=''>-- Selecione seu Estado --</option>");
        $.each(data, function(){
            $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
        });
    }).fail(function(){
        alert("Erro ao buscar pelos estados!");
    });
}

function cidadesJson(id){
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
        $select = $("select#cidade");

        $select.find("option").remove();
        $select.append("<option value=''>-- Selecione sua Cidade --</option>");
        $.each(data, function(){
            $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
        });
    }).fail(function(){
        // alert("Erro ao buscar pelas cidades!");
        alert("Não existem Cidades cadastradas para este Estado!");
    });
}

function bairrosJson(id){
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
        $select = $("select#bairro");

        $select.find("option").remove();
        $select.append("<option value=''>-- Selecione seu Bairro --</option>");
        $.each(data, function(){
            $select.append("<option value='"+this.id+"'>"+this.nome+"</option>");
        });
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

$(document).ready(function(){

});