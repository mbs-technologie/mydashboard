<?php
/*
 -------------------------------------------------------------------------
 MyDashboard plugin for GLPI
 Copyright (C) 2015 by the MyDashboard Development Team.
 -------------------------------------------------------------------------

 LICENSE

 This file is part of MyDashboard.

 MyDashboard is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 MyDashboard is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with MyDashboard. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

include('../../../inc/includes.php');

Session::checkLoginUser();


if (Session::getCurrentInterface() == 'central') {
   Html::header(PluginMydashboardMenu::getTypeName(1), '', "tools", "pluginmydashboardmenu");
} else {
   Html::helpHeader(PluginMydashboardMenu::getTypeName(1));
}

if (Session::haveRightsOr("plugin_mydashboard", [READ, UPDATE])) {
   if (isset($_POST["add_ticket"])) {

      Ticket::showFormHelpdesk(Session::getLoginUserID(), $_POST["tickettemplates_id"]);

   } else {

      ?>
       <!--<!DOCTYPE html>-->
       <html>
       <head>
           <link type="text/css" href="../css/style_bootstrap_main.css" rel="stylesheet">
           <link type="text/css" href="../css/style_bootstrap_ticket.css" rel="stylesheet">
           <!--DATATABLES CSS-->
           <link type="text/css" href="../lib/datatables/datatables.min.css" rel="stylesheet">
           <link type="text/css" href="../lib/datatables/Responsive-2.2.2/css/responsive.dataTables.min.css"
                 rel="stylesheet">
           <link type="text/css" href="../lib/datatables/Select-1.2.6/css/select.dataTables.min.css" rel="stylesheet">
           <link type="text/css" href="../lib/datatables/Buttons-1.5.2/css/buttons.dataTables.min.css" rel="stylesheet">
           <link type="text/css" href="../lib/datatables/ColReorder-1.5.0/css/colReorder.dataTables.min.css"
                 rel="stylesheet">

           <!--GLPI-->
           <link type="text/css" href="../../../lib/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
           <link type="text/css" href="../../../lib/gridstack/src/gridstack.css" rel="stylesheet">
           <link type="text/css" href="../../../lib/gridstack/src/gridstack-extra.css" rel="stylesheet">
           <script src="../../../lib/lodash.min.js"></script>
           <script src="../../../lib/gridstack/src/gridstack.js"></script>
           <script src="../../../lib/gridstack/src/gridstack.jQueryUI.js"></script>

           <!--DATATABLES-->
           <script src="../lib/datatables/datatables.min.js"></script>
           <script src="../lib/datatables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
           <script src="../lib/datatables/Select-1.2.6/js/dataTables.select.min.js"></script>
           <script src="../lib/datatables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
           <script src="../lib/datatables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
           <script src="../lib/datatables/Buttons-1.5.2/js/buttons.print.min.js"></script>
           <script src="../lib/datatables/Buttons-1.5.2/js/buttons.colVis.min.js"></script>
           <script src="../lib/datatables/ColReorder-1.5.0/js/dataTables.colReorder.min.js"></script>
           <script src="../lib/datatables/JSZip-2.5.0/jszip.min.js"></script>
           <script src="../lib/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
           <script src="../lib/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
           <!--MOMENT FOR DATATABLES-->
           <script src="../lib/moment.min.js"></script>
           <script src="../lib/datetime-moment.js"></script>
           <!--CHARTJS-->
           <script src="../lib/chartjs/Chart.min.js"></script>
           <!--EXPORT CHARTJS-->
           <script src="../lib/html2canvas.min.js"></script>
           <script src="../lib/fileSaver.min.js"></script>
           <!--CIRCLES STATS-->
           <script src="../lib/circles/circles.min.js"></script>
           <!--COUNTS-->
           <script src="../lib/countUp.min.js"></script>
           <script src="../lib/countUp-jquery.js"></script>

          <?php
          //$apikey = PluginMydashboardHelper::getGoogleApiKey();
          //if (!empty($apikey)) {
          //   echo "<script src='https://maps.googleapis.com/maps/api/js?key=$apikey'></script>";
          //}
          ?>

       </head>
       <body>

       <?php

       $profile         = (isset($_SESSION['glpiactiveprofile']['id'])) ? $_SESSION['glpiactiveprofile']['id'] : -1;
       $predefined_grid = 0;

       if (isset($_POST["profiles_id"])) {
          $profile = $_POST["profiles_id"];
       }
       if (isset($_POST["predefined_grid"])) {
          $predefined_grid = $_POST["predefined_grid"];
       }
       $dashboard = new PluginMydashboardMenu();
       $dashboard->loadDashboard($profile, $predefined_grid);
       //       $options=[];
       //       $dashboard->display($options);

       ?>

       </body>
       </html>

      <?php

   }
} else {
   Html::displayRightError();
}
if (Session::getCurrentInterface() == 'central') {
   Html::footer();
} else {
   Html::helpFooter();
}
