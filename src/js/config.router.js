'use strict';

/**
 * Config for the router
 */
 angular.module('app')
 .run(
  [          '$rootScope', '$state', '$stateParams', '$http',
  function ($rootScope,   $state,   $stateParams , $http) {
    $rootScope.$state = $state;

    $rootScope.$stateParams = $stateParams; 

  }])

 .config(
  [          '$stateProvider', '$urlRouterProvider', 'JQ_CONFIG', 'MODULE_CONFIG', '$authProvider', '$ocLazyLoadProvider','$locationProvider',
  function ($stateProvider,   $urlRouterProvider, JQ_CONFIG, MODULE_CONFIG, $authProvider, $ocLazyLoadProvider, $locationProvider) {
/*    
     //check browser support
        if(window.history && window.history.pushState){
        $locationProvider.html5Mode(true); //will cause an error $location in HTML5 mode requires a  tag to be present! Unless you set baseUrl tag after head tag like so: <head> <base href="/">

         // to know more about setting base URL visit: https://docs.angularjs.org/error/$location/nobase

         // if you don't wish to set base URL then use this
         $locationProvider.html5Mode({
                 enabled: true,
                 requireBase: false
          }); 
        }
*/
    var layout = "tpl/app.html";
    if(window.location.href.indexOf("material") > 0){
      layout = "tpl/blocks/material.layout.html";
      $urlRouterProvider
      .otherwise('/app/dashboard-v3');
    }else{
      $urlRouterProvider
      .otherwise('/app/dashboard-v3');
    }

    

    $stateProvider
    .state('login', {
      url: '/login',
      templateUrl: 'tpl/page_signin.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load([
              'js/services/services-admin.js',
              'js/controllers/signin.js']);
        }]
      }
    })
    .state('signup', {
      url: '/signup',
      templateUrl: 'tpl/page_signup.html',
      controller: 'SignupCtrl',
      resolve: {
        skipIfLoggedIn: skipIfLoggedIn,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load([
              'js/services/services-admin.js',
              'js/controllers/signup.js']);
        }]
      }
    })
    .state('logout', {
      url: '/logout',
      template: null,
      controller: 'SignoutCtrl',
      resolve: load(['js/controllers/signout.js','js/controllers/bootstrap.js'])
    })
    .state('app', {
      abstract: true,
      url: '/app',
      templateUrl: layout
    })
    .state('app.dashboard', {
      url: '/dashboard-v1',
      templateUrl: 'tpl/app_dashboard_v3.html',
      resolve: {
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
            // you can lazy load files for an existing module
             return $ocLazyLoad.load(['xeditable','js/controllers/xeditable.js','js/controllers/alert.js',
              'smart-table','js/controllers/table.js','js/controllers/adminUserController.js',
              'js/controllers/chart.js',
              'ui.grid',
              'js/controllers/uigrid.js',
              'js/services/services-admin.js',
              'js/controllers/albumController.js']);
        }]
      }
    })

    .state('app.quart1', {
      url: '/quart-1',
      templateUrl: 'tpl/quart1.html',
      resolve :{
        loginRequiredUser: loginRequiredUser,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/quart1Ctrl.js'
            ]);
        }]
      }

    })

    .state('app.integration-ventes', {
      url: '/integration-ventes',
      templateUrl: 'tpl/integration-ventes.html',
      resolve : {
        loginRequiredUser: loginRequiredUser,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select','angularFileUpload', 'js/controllers/material.js','js/services/services-admin.js',
            'js/controllers/bootstrap.js', 'js/controllers/integration-ventesCtrl.js'
            ]);
        }]
      }

    })

    .state('app.suppression-quart', {
      url: '/suppression-quart',
      templateUrl: 'tpl/suppression-quart.html',
      resolve : {
        loginRequiredUser: loginRequiredUser,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['ui.select', 'js/controllers/material.js',
            'js/controllers/bootstrap.js', 'js/controllers/suppression-quartCtrl.js'
            ]);
        }]
      }

    })

    .state('app.balance-agee', {
      url: '/balance-agee',
      templateUrl: 'tpl/balance-agee.html',
      resolve : {
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['ui.select', 'js/controllers/material.js',
            'js/controllers/bootstrap.js', 'js/controllers/balance-ageeCtrl.js'
            ]);
        }]
      }

    })

    .state('app.controle-reglement', {
      url: '/controle-reglement',
      templateUrl: 'tpl/controle-reglement.html',
      resolve : {
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable', 'ui.select', 'js/controllers/material.js',
            'js/controllers/bootstrap.js', 'js/controllers/controle-reglementCtrl.js'
            ]);
        }]
      }

    })

    .state('app.analyse-ventes', {
      url: '/analyse-ventes',
      templateUrl: 'tpl/analyse-ventes.html',
      resolve : {
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['ui.select', 'js/controllers/material.js',
            'js/controllers/bootstrap.js', 'js/controllers/analyse-ventesCtrl.js'
            ]);
        }]
      }

    })

    .state('app.etatVentes', {
      url: '/etats-ventes',
      templateUrl: 'tpl/etats_ventes.html',
      controller: 'etatVentesCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatVentesCtrl.js'
            ]);
        }]
      }

    })


    .state('app.pompistes', {
      url: '/pompistes',
      templateUrl: 'tpl/pompistes.html',
      controller: 'pompisteCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/pompisteCtrl.js'
            ]);
        }]
      }
    })

    .state('app.lubrifiants', {
      url: '/lubrifiants',
      templateUrl: 'tpl/lubrifiants.html',
      controller: 'lubrifiantsCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/lubrifiantsCtrl.js'
            ]);
        }]
      }
    })


    .state('app.etatManquants', {
      url: '/etats-manquant',
      templateUrl: 'tpl/etats_Manquants.html',
      controller: 'etatManquantsCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatManquantsCtrl.js'
            ]);
        }]
      }

    })

  

    .state('app.etatCoulages', {
      url: '/etats-coulages',
      templateUrl: 'tpl/etats_coulages.html',
      controller: 'etatCoulagesCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatCoulagesCtrl.js'
            ]);
        }]
      }

    })

    .state('app.etatStocks', {
      url: '/etats-stocks',
      templateUrl: 'tpl/etats_stocks.html',
      controller: 'etatStockCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatStockCtrl.js'
            ]);
        }]
      }

    })

    .state('app.etatLubrifiants', {
      url: '/etats-lubrifiant',
      templateUrl: 'tpl/etats_Lubrifiants.html',
      controller: 'etatLubrifiantsCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatLubrifiantsCtrl.js'
            ]);
        }]
      }

    })


    .state('app.etatGaz', {
      url: '/etats-gaz',
      templateUrl: 'tpl/etats_Gaz.html',
      controller: 'etatGazCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatGazCtrl.js'
            ]);
        }]
      }

    })

    .state('app.etatVersements', {
      url: '/etats-versements',
      templateUrl: 'tpl/etats_versements.html',
      controller: 'etatVersementsCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatVersementsCtrl.js'
            ]);
        }]
      }

    })


    .state('app.etatCreances', {
      url: '/etats-creances',
      templateUrl: 'tpl/etats_creances.html',
      controller: 'etatCreancesCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatCreancesCtrl.js'
            ]);
        }]
      }

    })

    .state('app.suiviManquants', {
      url: '/suivi_manquants',
      templateUrl: 'tpl/suivi_manquants.html',
      controller: 'suiviManquantCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/suiviManquantCtrl.js'
            ]);
        }]
      }
    })


    .state('app.station', {
      url: '/station',
      templateUrl: 'tpl/station.html',
      controller: 'stationCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select','js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/stationCtrl.js'
            ]);
        }]
      }

    })


    .state('app.produit', {
      url: '/produit',
      templateUrl: 'tpl/produit.html',
      controller: 'produitCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select','js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/produitCtrl.js'
            ]);
        }]
      }

    })

     .state('app.client', {
      url: '/client',
      templateUrl: 'tpl/client.html',
      controller: 'clientCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select','js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/clientCtrl.js'
            ]);
        }]
      }

    })


    .state('app.transporteur', {
      url: '/transporteur',
      templateUrl: 'tpl/transporteur.html',
      controller: 'transporteurCtrl',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select','js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/transporteurCtrl.js'
            ]);
        }]
      }

    })

    .state('app.banners', {
      url: '/banners',
      templateUrl: 'tpl/banners.html',
      controller: 'bannerCtrl',
      resolve :load(['xeditable', 'js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/bannerCtrl.js'
            ])

    })

     .state('app.albums', {
      url: '/albums',
      templateUrl: 'tpl/albums.html',
      controller: 'albumCtrl',
      resolve :load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/albumCtrl.js'
            ])

    })

      .state('app.songs', {
      url: '/songs',
      templateUrl: 'tpl/songs.html',
      controller: 'songCtrl',
      resolve :load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/songCtrl.js',
            'js/controllers/bootstrap.js'
            ])

    })

       .state('app.playlists', {
      url: '/playlists',
      templateUrl: 'tpl/playlists.html',
      controller: 'playlistCtrl',
      resolve :{
        loginRequired: loginRequired,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/playlistCtrl.js'
            ]);
        }]
      }
    })

     .state('app.articles', {
      url: '/articles',
      templateUrl: 'tpl/articles.html',
      controller: 'articleCtrl',
      resolve :load(['xeditable','js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/articleCtrl.js',
            'js/controllers/bootstrap.js'
            ])

    })


     .state('app.videos', {
      url: '/videos',
      templateUrl: 'tpl/videos.html',
      controller: 'videoCtrl',
      resolve :load(['xeditable','ui.select', 'js/controllers/alert.js',
            'js/services/services-admin.js',
            'js/controllers/videoCtrl.js'

            ])

    })


     .state('app.users', {
      url: '/users',
      templateUrl: 'tpl/users.html',
      controller: 'userCtrl',
      resolve : {
        loginRequired: loginRequired,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select',
              'js/services/services-admin.js',
              'js/controllers/userCtrl.js']);
        }]
      }
    })

       .state('app.beats', {
      url: '/beats',
      templateUrl: 'tpl/beats.html',
      controller: 'beatCtrl',
      resolve :load(['xeditable','ui.select',
            'js/services/services-admin.js',
            'js/controllers/beatCtrl.js'
            
            ])

    })

    .state('app.submit', {
      url: '/submit',
      templateUrl: 'tpl/submit.html',
      controller: 'submitCtrl',
      resolve :load(['xeditable','ui.select',
            'js/services/services-admin.js',
            'js/controllers/submitCtrl.js'
            
            ])

    })

    .state('app.decouvert', {
      url: '/etats-decouvert',
      templateUrl: 'tpl/etats_decouvert.html',
      controller: 'etatDecouvertCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatDecouvertCtrl.js'
            ]);
        }]
      }

    })


    .state('app.etatCoulagesConso', {
      url: '/etats-coulages-conso',
      templateUrl: 'tpl/etats_coulages_reseau.html',
      controller: 'etatCoulagesReseauCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatCoulagesReseauCtrl.js'
            ]);
        }]
      }

    })

    .state('app.reglementClient', {
      url: '/reglement_client',
      templateUrl: 'tpl/reglement_client.html',
      resolve :{
       // loginRequiredUser: loginRequiredUser,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/material.js', 'js/controllers/bootstrap.js',
            'js/controllers/reglementClientCtrl.js'
            ]);
        }]
      }

    })


    .state('app.controleMobileMoney', {
      url: '/controle_mobilemoney',
      templateUrl: 'tpl/controle_mobilemoney.html',
      resolve :{
        loginRequiredAdmin: loginRequiredAdmin,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/material.js', 'js/controllers/bootstrap.js',
            'js/controllers/controleMobileMoneyCtrl.js'
            ]);
        }]
      }

    })

    .state('app.etatVentesConso', {
      url: '/etats-ventes-conso',
      templateUrl: 'tpl/etats_ventes_reseau.html',
      controller: 'etatVentesReseauCtrl',
      resolve :{
        
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'angularFileUpload', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js',
            'js/controllers/etatVentesReseauCtrl.js'
            ]);
        }]
      }

    })



    .state('app.dashboard-v2', {
      url: '/dashboard-v2',
      templateUrl: 'tpl/app_dashboard_v2.html',
      resolve: load(['js/controllers/chart.js'])
    })


    .state('app.dashboard-v3', {
      url: '/dashboard-v3',
      controller : 'dashboardCtrl',
      templateUrl: 'tpl/app_dashboard_v3.html',
      resolve :{
        loginRequired: loginRequired,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['xeditable','ui.select', 'js/controllers/material.js',
            'js/services/services-admin.js', 'js/controllers/bootstrap.js', 'js/controllers/chart.js',
            'js/controllers/dashboardCtrl.js'
            ]);
        }]
      }

    })



    .state('app.ui', {
      url: '/ui',
      template: '<div ui-view class="fade-in-up"></div>'
    })
    .state('app.ui.buttons', {
      url: '/buttons',
      templateUrl: 'tpl/ui_buttons.html'
    })
    .state('app.ui.icons', {
      url: '/icons',
      templateUrl: 'tpl/ui_icons.html'
    })
    .state('app.ui.grid', {
      url: '/grid',
      templateUrl: 'tpl/ui_grid.html'
    })
    .state('app.ui.widgets', {
      url: '/widgets',
      templateUrl: 'tpl/ui_widgets.html'
    })
    .state('app.ui.bootstrap', {
      url: '/bootstrap',
      templateUrl: 'tpl/ui_bootstrap.html'
    })
    .state('app.ui.sortable', {
      url: '/sortable',
      templateUrl: 'tpl/ui_sortable.html'
    })
    .state('app.ui.scroll', {
      url: '/scroll',
      templateUrl: 'tpl/ui_scroll.html',
      resolve: load('js/controllers/scroll.js')
    })
    .state('app.ui.portlet', {
      url: '/portlet',
      templateUrl: 'tpl/ui_portlet.html'
    })
    .state('app.ui.timeline', {
      url: '/timeline',
      templateUrl: 'tpl/ui_timeline.html'
    })
    .state('app.ui.tree', {
      url: '/tree',
      templateUrl: 'tpl/ui_tree.html',
      resolve: load(['angularBootstrapNavTree', 'js/controllers/tree.js'])
    })
    .state('app.ui.toaster', {
      url: '/toaster',
      templateUrl: 'tpl/ui_toaster.html',
      resolve: load(['toaster', 'js/controllers/toaster.js'])
    })
    .state('app.ui.jvectormap', {
      url: '/jvectormap',
      templateUrl: 'tpl/ui_jvectormap.html',
      resolve: load('js/controllers/vectormap.js')
    })
    .state('app.ui.googlemap', {
      url: '/googlemap',
      templateUrl: 'tpl/ui_googlemap.html',
      resolve: load(['js/app/map/load-google-maps.js', 'js/app/map/ui-map.js', 'js/app/map/map.js'], function(){ return loadGoogleMaps(); })
    })
    .state('app.chart', {
      url: '/chart',
      templateUrl: 'tpl/ui_chart.html',
      resolve: {
        loginRequired: loginRequired,
        loadMyCtrl: ['$ocLazyLoad', function($ocLazyLoad) {
             return $ocLazyLoad.load(['js/controllers/chart.js']);
        }]
      //  loginRequired: loginRequired,
      //  load('js/controllers/chart.js')

      }
       
    })
              // table
              .state('app.table', {
                url: '/table',
                template: '<div ui-view></div>'
              })
              .state('app.table.static', {
                url: '/static',
                templateUrl: 'tpl/table_static.html'
              })
              .state('app.table.datatable', {
                url: '/datatable',
                templateUrl: 'tpl/table_datatable.html'
              })
              .state('app.table.footable', {
                url: '/footable',
                templateUrl: 'tpl/table_footable.html'
              })
              .state('app.table.grid', {
                url: '/grid',
                templateUrl: 'tpl/table_grid.html',
                resolve: load(['ngGrid','js/controllers/grid.js'])
              })
              .state('app.table.uigrid', {
                url: '/uigrid',
                templateUrl: 'tpl/table_uigrid.html',
                resolve: load(['ui.grid','js/controllers/uigrid.js'])
              })
              .state('app.table.editable', {
                url: '/editable',
                templateUrl: 'tpl/table_editable.html',
                controller: 'XeditableCtrl',
                resolve: load(['xeditable','js/controllers/xeditable.js'])
              })
              .state('app.table.smart', {
                url: '/smart',
                templateUrl: 'tpl/table_smart.html',
                resolve: load(['smart-table','js/controllers/table.js'])
              })
              // form
              .state('app.form', {
                url: '/form',
                template: '<div ui-view class="fade-in"></div>',
                resolve: load('js/controllers/form.js')
              })
              .state('app.form.components', {
                url: '/components',
                templateUrl: 'tpl/form_components.html',
                resolve: load(['ngBootstrap','daterangepicker','js/controllers/form.components.js'])
              })
              .state('app.form.elements', {
                url: '/elements',
                templateUrl: 'tpl/form_elements.html'
              })
              .state('app.form.validation', {
                url: '/validation',
                templateUrl: 'tpl/form_validation.html'
              })
              .state('app.form.wizard', {
                url: '/wizard',
                templateUrl: 'tpl/form_wizard.html'
              })
              .state('app.form.fileupload', {
                url: '/fileupload',
                templateUrl: 'tpl/form_fileupload.html',
                resolve: load(['angularFileUpload','js/controllers/file-upload.js'])
              })
              .state('app.form.imagecrop', {
                url: '/imagecrop',
                templateUrl: 'tpl/form_imagecrop.html',
                resolve: load(['ngImgCrop','js/controllers/imgcrop.js'])
              })
              .state('app.form.select', {
                url: '/select',
                templateUrl: 'tpl/form_select.html',
                controller: 'SelectCtrl',
                resolve: load(['ui.select','js/controllers/select.js'])
              })
              .state('app.form.slider', {
                url: '/slider',
                templateUrl: 'tpl/form_slider.html',
                controller: 'SliderCtrl',
                resolve: load(['vr.directives.slider','js/controllers/slider.js'])
              })
              .state('app.form.editor', {
                url: '/editor',
                templateUrl: 'tpl/form_editor.html',
                controller: 'EditorCtrl',
                resolve: load(['textAngular','js/controllers/editor.js'])
              })
              .state('app.form.xeditable', {
                url: '/xeditable',
                templateUrl: 'tpl/form_xeditable.html',
                controller: 'XeditableCtrl',
                resolve: load(['xeditable','js/controllers/xeditable.js'])
              })
              // pages
              .state('app.page', {
                url: '/page',
                template: '<div ui-view class="fade-in-down"></div>'
              })
              .state('app.page.profile', {
                url: '/profile',
                templateUrl: 'tpl/page_profile.html'
              })
              .state('app.page.post', {
                url: '/post',
                templateUrl: 'tpl/page_post.html'
              })
              .state('app.page.search', {
                url: '/search',
                templateUrl: 'tpl/page_search.html'
              })
              .state('app.page.invoice', {
                url: '/invoice',
                templateUrl: 'tpl/page_invoice.html'
              })
              .state('app.page.price', {
                url: '/price',
                templateUrl: 'tpl/page_price.html'
              })
              .state('app.docs', {
                url: '/docs',
                templateUrl: 'tpl/docs.html'
              })
              // others
              .state('lockme', {
                url: '/lockme',
                templateUrl: 'tpl/page_lockme.html'
              })
              .state('access', {
                url: '/access',
                template: '<div ui-view class="fade-in-right-big smooth"></div>'
              })
              .state('access.signin', {
                url: '/signin',
                templateUrl: 'tpl/page_signin.html',
                resolve: load( ['js/controllers/signin.js'] )
              })
              .state('access.signup', {
                url: '/signup',
                templateUrl: 'tpl/page_signup.html',
                resolve: load( ['js/controllers/signup.js'] )
              })
              .state('access.forgotpwd', {
                url: '/forgotpwd',
                templateUrl: 'tpl/page_forgotpwd.html'
              })
              .state('access.404', {
                url: '/404',
                templateUrl: 'tpl/page_404.html'
              })

              // fullCalendar
              .state('app.calendar', {
                url: '/calendar',
                templateUrl: 'tpl/app_calendar.html',
                  // use resolve to load other dependences
                  resolve: load(['moment','fullcalendar','ui.calendar','js/app/calendar/calendar.js'])
                })

              // mail
              .state('app.mail', {
                abstract: true,
                url: '/mail',
                templateUrl: 'tpl/mail.html',
                  // use resolve to load other dependences
                  resolve: load( ['js/app/mail/mail.js','js/app/mail/mail-service.js','moment'] )
                })
              .state('app.mail.list', {
                url: '/inbox/{fold}',
                templateUrl: 'tpl/mail.list.html'
              })
              .state('app.mail.detail', {
                url: '/{mailId:[0-9]{1,4}}',
                templateUrl: 'tpl/mail.detail.html'
              })
              .state('app.mail.compose', {
                url: '/compose',
                templateUrl: 'tpl/mail.new.html'
              })

              .state('layout', {
                abstract: true,
                url: '/layout',
                templateUrl: 'tpl/layout.html'
              })
              .state('layout.fullwidth', {
                url: '/fullwidth',
                views: {
                  '': {
                    templateUrl: 'tpl/layout_fullwidth.html'
                  },
                  'footer': {
                    templateUrl: 'tpl/layout_footer_fullwidth.html'
                  }
                },
                resolve: load( ['js/controllers/vectormap.js'] )
              })
              .state('layout.mobile', {
                url: '/mobile',
                views: {
                  '': {
                    templateUrl: 'tpl/layout_mobile.html'
                  },
                  'footer': {
                    templateUrl: 'tpl/layout_footer_mobile.html'
                  }
                }
              })
              .state('layout.app', {
                url: '/app',
                views: {
                  '': {
                    templateUrl: 'tpl/layout_app.html'
                  },
                  'footer': {
                    templateUrl: 'tpl/layout_footer_fullwidth.html'
                  }
                },
                resolve: load( ['js/controllers/tab.js'] )
              })
              .state('apps', {
                abstract: true,
                url: '/apps',
                templateUrl: 'tpl/layout.html'
              })
              .state('apps.note', {
                url: '/note',
                templateUrl: 'tpl/apps_note.html',
                resolve: load( ['js/app/note/note.js','moment'] )
              })
              .state('apps.contact', {
                url: '/contact',
                templateUrl: 'tpl/apps_contact.html',
                resolve: load( ['js/app/contact/contact.js'] )
              })
              .state('app.weather', {
                url: '/weather',
                templateUrl: 'tpl/apps_weather.html',
                resolve: load(['js/app/weather/skycons.js','angular-skycons','js/app/weather/ctrl.js','moment'])
              })
              .state('app.todo', {
                url: '/todo',
                templateUrl: 'tpl/apps_todo.html',
                resolve: load(['js/app/todo/todo.js', 'moment'])
              })
              .state('app.todo.list', {
                url: '/{fold}'
              })
              .state('app.note', {
                url: '/note',
                templateUrl: 'tpl/apps_note_material.html',
                resolve: load(['js/app/note/note.js', 'moment'])
              })
              .state('music', {
                url: '/music',
                templateUrl: 'tpl/music.html',
                controller: 'MusicCtrl',
                resolve: load([
                  'com.2fdevs.videogular',
                  'com.2fdevs.videogular.plugins.controls',
                  'com.2fdevs.videogular.plugins.overlayplay',
                  'com.2fdevs.videogular.plugins.poster',
                  'com.2fdevs.videogular.plugins.buffering',
                  'js/app/music/ctrl.js',
                  'js/app/music/theme.css'
                  ])
              })
              .state('music.home', {
                url: '/home',
                templateUrl: 'tpl/music.home.html'
              })
              .state('music.genres', {
                url: '/genres',
                templateUrl: 'tpl/music.genres.html'
              })
              .state('music.detail', {
                url: '/detail',
                templateUrl: 'tpl/music.detail.html'
              })
              .state('music.mtv', {
                url: '/mtv',
                templateUrl: 'tpl/music.mtv.html'
              })
              .state('music.mtvdetail', {
                url: '/mtvdetail',
                templateUrl: 'tpl/music.mtv.detail.html'
              })
              .state('music.playlist', {
                url: '/playlist/{fold}',
                templateUrl: 'tpl/music.playlist.html'
              })
              .state('app.material', {
                url: '/material',
                template: '<div ui-view class="wrapper-md"></div>',
                resolve: load(['js/controllers/material.js'])
              })
              .state('app.material.button', {
                url: '/button',
                templateUrl: 'tpl/material/button.html'
              })
              .state('app.material.color', {
                url: '/color',
                templateUrl: 'tpl/material/color.html'
              })
              .state('app.material.icon', {
                url: '/icon',
                templateUrl: 'tpl/material/icon.html'
              })
              .state('app.material.card', {
                url: '/card',
                templateUrl: 'tpl/material/card.html'
              })
              .state('app.material.form', {
                url: '/form',
                templateUrl: 'tpl/material/form.html'
              })
              .state('app.material.list', {
                url: '/list',
                templateUrl: 'tpl/material/list.html'
              })
              .state('app.material.ngmaterial', {
                url: '/ngmaterial',
                templateUrl: 'tpl/material/ngmaterial.html'
              });

              $authProvider.authHeader = 'Authorization';
              $authProvider.authToken = 'Bearer';
              $authProvider.storageType = 'localStorage';
              $authProvider.tokenName = 'token';

              $authProvider.facebook({
                clientId: '901473839934047',
                responseType: 'code',
                name: 'facebook',
                tokenName: 'token',
               url: 'http://178.62.12.238:8080/bimstr/rest/user/fblogin',
                authorizationEndpoint: 'https://www.facebook.com/dialog/oauth',
                redirectUri: 'http://178.62.12.238:8088/src/login',
                requiredUrlParams: ['display', 'scope'],
                scope: ['email', 'public_profile'],
                scopeDelimiter: ',',
                display: 'popup',
                type: '2.0',
                popupOptions: { width: 580, height: 400 }
              });

              function load(srcs, callback) {
                return {
                  deps: ['$ocLazyLoad', '$q',
                  function( $ocLazyLoad, $q ){
                    var deferred = $q.defer();
                    var promise  = false;
                    srcs = angular.isArray(srcs) ? srcs : srcs.split(/\s+/);
                    if(!promise){
                      promise = deferred.promise;
                    }
                    angular.forEach(srcs, function(src) {
                      promise = promise.then( function(){
                        if(JQ_CONFIG[src]){
                          return $ocLazyLoad.load(JQ_CONFIG[src]);
                        }
                        angular.forEach(MODULE_CONFIG, function(module) {
                          if( module.name == src){
                            name = module.name;
                          }else{
                            name = src;
                          }
                        });
                        return $ocLazyLoad.load(name);
                      } );
                    });
                    deferred.resolve();
                    return callback ? promise.then(function(){ return callback(); }) : promise;
                  }]
                }
              }

              function skipIfLoggedIn($q, $auth) {

                var deferred = $q.defer();
                if ($auth.isAuthenticated()) {
                  $state.go('app.dashboard');
                  deferred.reject();
                } else {
                  deferred.resolve();
                }
                return deferred.promise;
              }

              function loginRequiredAdmin($q, $location, $localStorage) {
                var deferred = $q.defer();
                console.log($localStorage.User);
                if ($localStorage.User.role == 'ADMINISTRATEUR') {
                  deferred.resolve();
                } else {
                  $location.path('/login');
                }
                return deferred.promise;
              }

               function loginRequiredUser($q, $location, $localStorage) {
                var deferred = $q.defer();
                console.log($localStorage.User);
                if ($localStorage.User.role == 'UTILISATEUR') {
                  deferred.resolve();
                } else {
                  $location.path('/login');
                }
                return deferred.promise;
              }

               function loginRequiredReg($q, $location, $localStorage) {
                var deferred = $q.defer();
                console.log($localStorage.User);
                if ($localStorage.User.role == 'REGIONAL') {
                  deferred.resolve();
                } else {
                  $location.path('/login');
                }
                return deferred.promise ;
              }

              function loginRequired($q, $location, $localStorage) {
                var deferred = $q.defer();
               // console.log($localStorage.User);
                if (($localStorage.User.role == 'UTILISATEUR') || ($localStorage.User.role == 'ADMINISTRATEUR') ) {
                  deferred.resolve();
                } else {
                  $location.path('/login');
                }
                return deferred.promise;
              }








            }]);
