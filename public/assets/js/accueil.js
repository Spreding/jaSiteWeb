window.onload = function () {
  filterSelection("all");
};

function filterSelection(c) {
  btns = document.getElementsByClassName("btn");
  for (let index = 0; index < btns.length; index++) {
    if (btns[index].className == "btn " + c) {
      $(btns[index]).addClass("active");
    } else {
      $(btns[index]).removeClass("active");
    }
  }
  var x, i;
  x = document.getElementsByClassName("item_projet");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

function OpenProjet(idProjet) {
  //console.log(idProjet);
  $.ajax({
    url: "/getInfoProjet",
    type: "GET",
    data: {
      idprojet: idProjet,
    },
    dataType: "json",
    async: true,

    success: function (data, status) {
      var pageProjet = document.getElementById("page_projet");
      var myContainer = document.getElementById("container_projet");
      var content = "";
      //console.log("url " + data["images"][1] + " size " + data["sizeIMG"][1]);
      content +=
        '<div class="titre_projet_div"> <p class="nom_projet">' + data["name"] +
        '</p><p class="type_projet">' + data["type"] +
        '</p><img class="img_trait_1" src="assets/img/trait_1.png" alt=""><p class="date_projet">' + data["date"] +
        '</p><img class="img_trait_2" src="assets/img/trait_2.png" alt=""></div>';
      var logiciels = data["logiciels"].replace(/,/g, "<br>");
      // '</p><p class="type_projet">' + data["type"] +
      //   
      content +=
        '<div class="description_projet_div"><div class="logiciel_box"><p class="logiciel_titre">LOGICIELS</p><p class="logiciel_liste">' +
        logiciels +
        '</p></div><div class="description_box"><p class="description_text">' +
        data["description"] +
        "</p></div></div>";
      content += '<div class="img_div">';
      for (let index = 0; index < data["images"].length; index++) {
        // console.log(data["images"][index].includes("mp4"));
        console.log(data["sizeIMG"][index][0]);
        if (data["images"][index][0].includes("mp4")) {
          content +=
            '<video controls class="imgProjet sizeProjet'+data["sizeIMG"][index][0]+'"> <source src=' +
            data["images"][index][0] +
            "> </video>";
        } else {
          content +=
            '<img class="imgProjet sizeProjet'+ data["sizeIMG"][index][0]+'" src=' +
            data["images"][index][0] +
            ' alt=""></img>';
        }
      }
      content += "</div>";
      myContainer.innerHTML += content;

      pageProjet.style.visibility = "visible";
      pageProjet.className += " animationPage";

      var el = document.querySelector(".animationPage");
      el.addEventListener("transitionend", function () {
        if (pageProjet.className =="page_projet page_projet_slider page_projet_container animationPage")
        {
          projetIsOpen();
        }
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      console.log("Ajax request failed. ");
    },
  });
}

function CloseProject() {
  var topnav = document.getElementById("topnav");
  var filterAccueil = document.getElementById("container_filter");
  var containerAccueil = document.getElementById("container_content");
  var pageProjet = document.getElementById("page_projet");
  var myContainer = document.getElementById("container_projet");

  topnav.className = "topnav";
  containerAccueil.className = "container";
  filterAccueil.className = "container_filter";
  pageProjet.style.visibility = "hidden";
  pageProjet.className = "page_projet page_projet_slider page_projet_container";
  myContainer.innerHTML = "";
}

function projetIsOpen() {
  var topnav = document.getElementById("topnav");
  var filterAccueil = document.getElementById("container_filter");
  var containerAccueil = document.getElementById("container_content");
  var pageProjet = document.getElementById("page_projet");

  topnav.className += " accueil_reveal";
  filterAccueil.className += " accueil_reveal";
  containerAccueil.className += " accueil_reveal";
  pageProjet.className += " reveal";
}
