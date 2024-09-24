
var app = angular.module('myApp', ['ngRoute','ngAnimate','ngMessages']);



/* header menu script start here */
app.controller('HeaderCntrl', function($scope) { 
    $scope.openNav = function() {
       
            document.getElementById("mySidenav").style.width = "250px";
            $("body").css({
                "margin-left": "250px",
                "overflow-x": "hidden",
                "transition": "margin-left .5s",
                "position": "fixed"
            });
            $("#main").addClass("overlay");


        }
 $scope.closeNav = function() {
        
            document.getElementById("mySidenav").style.width = "0";
            $("body").css({
                "margin-left": "0px",
                "transition": "margin-left .5s",
                "position": "relative"
            });
            $("#main").removeClass("overlay");
          
        }
});

//Flex Slider Start here
app.directive('flexCarousel', function () {
    return {
        restrict: 'E',
        transclude : true,
        template : "<ng-transclude></ng-transclude>",
        scope : {
          options : "="
        },
        link: function (scope, element, attrs) {
           
            $('#flexisel').flexisel(scope.options);
            $('#flexiselDemo2').flexisel(scope.options);
            
        }
    };
});
//Flex Slider End here

//******************************* Configure the Routes Start Here *******************************
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    // Home
    .when("/", { templateUrl: "home.html", controller: "PageCtrl" })
    .when("/dashboard-add-listing", { templateUrl: "dashboard-add-listing.html", controller: "PageCtrl" })
    .when("/dashboard-change-password", { templateUrl: "dashboard-change-password.html", controller: "PageCtrl" })
    .when("/dashboard-edit-profile", { templateUrl: "dashboard-edit-profile.html", controller: "PageCtrl" })
    .when("/dashboard-favorite", { templateUrl: "dashboard-favorite.html", controller: "PageCtrl" })
    .when("/dashboard-my-listing", { templateUrl: "dashboard-my-listing.html", controller: "PageCtrl" })
    .when("/dashboard-my-profile", { templateUrl: "dashboard-my-profile.html", controller: "PageCtrl" })
    .when("/dashboard-received-inquiry", { templateUrl: "dashboard-received-inquiry.html", controller: "PageCtrl" })
    .when("/dashboard-received-inquiry-view", { templateUrl: "dashboard-received-inquiry-view.html", controller: "PageCtrl" })
    .when("/listing", { templateUrl: "listing.html", controller: "PageCtrl" })
    .when("/listing-details", { templateUrl: "listing-details.html", controller: "PageCtrl" })
    .when("/404-page", { templateUrl: "404-page.html", controller: "PageCtrl" })    
    .when("/thankyou", { templateUrl: "thankyou.html", controller: "PageCtrl" })
    .when("/about-us", { templateUrl: "about-us.html", controller: "PageCtrl" })
    .when("/member-testimonials", { templateUrl: "member-testimonials.html", controller: "PageCtrl" })
     .when("/policy", { templateUrl: "policy.html", controller: "PageCtrl" })
    .when("/category-list", { templateUrl: "category-list.html", controller: "PageCtrl" })

    // else 404
    .otherwise("/404-page", { templateUrl: "404-page.html", controller: "PageCtrl" });
} ]);
app.controller('PageCtrl', function ( $scope,$location/*, $location, $http */) {
    console.log("Page Controller reporting for duty.");
   // $scope.pageClass = 'page-effect';
    console.log($location.path());
});

//******************************* Configure the Routes End Here *******************************

/* footer start here */

app.directive('slideToggle', function() {  
  return {
    restrict: 'A',      
    scope:{},
    controller: function ($scope) {}, 
    link: function(scope, element, attr) {
      element.bind('click', function() {                  
        var $slideBox = angular.element(attr.slideToggle);
        var slideDuration = parseInt(attr.slideToggleDuration, 10) || 200;
        $slideBox.stop().slideToggle(slideDuration);
        $(this).find('.angel-icon i').toggleClass('fa-angle-right fa-angle-down');
          
      });
    }
  };  
});
/* footer end here */

/*sidebar start here*/
app.directive('submenuToggle', function() {  
  return {
    restrict: 'A',      
    scope:{},
    controller: function ($scope) {}, 
    link: function(scope, element, attr) {
      element.bind('click', function() {                  
        var $slideBox = angular.element(attr.submenuToggle);
        var submenuDuration = parseInt(attr.submenuDuration, 10) || 200;
        $slideBox.stop().slideToggle(submenuDuration);
        $(this).toggleClass('active');  
        $(this).find('.arrow i').toggleClass('fa-angle-down fa-angle-up');
          
      });
    }
  };  
});
/*sidebar end here*/


//*******************************UPLOAD IMAGE STRART HERE**********************************************

app.controller("uploadImage", ['$scope', '$http', 'uploadService', function($scope, $http, uploadService) {
    $scope.$watch('file', function(newfile, oldfile) {
      if(angular.equals(newfile, oldfile) ){
        return;
      }

      uploadService.upload(newfile).then(function(res){
        // DO SOMETHING WITH THE RESULT!
        console.log("result", res);
      })
    });

  }])
  app.service("uploadService", function($http, $q) {

    return ({
      upload: upload
    });

    function upload(file) {
      var upl = $http({
        method: 'POST',
        url: 'http://jsonplaceholder.typicode.com/posts', // /api/upload
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        data: {
          upload: file
        },
        transformRequest: function(data, headersGetter) {
          var formData = new FormData();
          angular.forEach(data, function(value, key) {
            formData.append(key, value);
          });

          var headers = headersGetter();
          delete headers['Content-Type'];

          return formData;
        }
      });
      return upl.then(handleSuccess, handleError);

    } // End upload function

    // ---
    // PRIVATE METHODS.
    // ---
  
    function handleError(response, data) {
      if (!angular.isObject(response.data) ||!response.data.message) {
        return ($q.reject("An unknown error occurred."));
      }

      return ($q.reject(response.data.message));
    }

    function handleSuccess(response) {
      return (response);
    }

  })
  app.directive("fileinput", [function() {
    return {
      scope: {
        fileinput: "=",
        filepreview: "="
      },
      link: function(scope, element, attributes) {
        element.bind("change", function(changeEvent) {
          scope.fileinput = changeEvent.target.files[0];
          var reader = new FileReader();
          reader.onload = function(loadEvent) {
            scope.$apply(function() {
              scope.filepreview = loadEvent.target.result;
            });
          }
          reader.readAsDataURL(scope.fileinput);
        });
      }
    }
  }]);

//*******************************UPLOAD IMAGE END HERE**********************************************



