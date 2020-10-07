<?php
   /**
    * @file  index.php
    **/

    /**
     * @brief class managing all documentation related actions
     **/
    class doctemplate {
      var $error;

      /**
       * @brief constructor
       **/
      function __construct() {
        $this->error = false;

        $config = new \stdClass();
        $config->doxygenDir = '/docs/doxygen-sources/';
        $config->doxygenConfigFile = "doxygen";
        $config->doxygenDirOut = '/docs/doxygen/';

        $config->sphinxDir = '/docs/sphinx-sources/';
        $config->sphinxConfigFile = "conf.py";
        $config->sphinxIndexFile = "index.rst";
        $config->sphinxDirOut = '/docs/sphinxdocs/';

        $this->config = $config;

        // do some sanity check
        $this->checkSetup();
        if ($this->error) $this->echoErrors();

        // running the logic
        $this->run();
      }


      /**
       * @brief running the logic
       **/
      private function run() {
        // checking if an action has been provided
        if (!isset($_GET['action'])) return;

        // fixing errors first
        // copying doxygen config from repo in case user does want one
        if ($_GET['action']=="createDoxygenConfig") {
          $this->outputShell('mkdir -p ' . $this->config->doxygenDir . ' && cp /repo/config/' . $this->config->doxygenConfigFile . ' ' . $this->config->doxygenDir, "updating Doxygen");
        }

        // copying sphinx config from repo in case user does want one
        if ($_GET['action']=="createSphinxConfig") {
          $this->outputShell('mkdir -p ' . $this->config->sphinxDir . ' && cp /repo/config/' . $this->config->sphinxConfigFile . ' ' . $this->config->sphinxDir, "updating Sphinxdocs");
        }

        // copying sphinx config from repo in case user does want one
        if ($_GET['action']=="createSphinxIndex") {
          $this->outputShell('mkdir -p ' . $this->config->sphinxDir . ' && cp /repo/config/' . $this->config->sphinxIndexFile . ' ' . $this->config->sphinxDir, "updating Sphinxdocs");
        }

        if ($this->error) {
          echo " <b>fix errors first</b>";
        //  return;
        }

        //generate doxygen
        if ($_GET['action']=="doxygen") {
          $this->runDoxygen();
        }


        // generate sphinxdocs
        if ($_GET['action']=="sphinxdocs") {
          $this->runSphinxdocs();
        }

        // show directory content
        if ($_GET['action']=="showDir") {
          $this->outputShell('ls -laR /docs', "Show processed folder content");
        }

        // show php info
        if ($_GET['action']=="phpinfo") {
          echo phpinfo();
        }
      }

      private function runDoxygen() {
        $this->outputShell('doxygen ' . $this->config->doxygenDir . $this->config->doxygenConfigFile, "updating Doxygen");
      }

      private function runSphinxdocs() {
        $this->outputShell('sphinx-build -b html ' . $this->config->sphinxDir . ' /docs/sphinxdocs', "updating Sphinxdocs");
      }

      /**
       * @brief checks for correct setup of the system
       **/
      private function checkSetup() {
        if (!is_dir('/docs')) {
          $this->errorMsg[] = "directory for documents not linked - please check docker-compose.yml to link /docs";
          $this->error = true;
        }

        if ($this->is_dir_empty('/docs')) {
          $this->errorMsg[] = "directory for documents empty.";
          $this->error = true;
        }

        // is there a source directory to parse for doxygen?
        if (!is_dir('/src')) {
          $this->errorMsg[] = "directory for source code not linked - please check docker-compose.yml to link /src";
          $this->error = true;
        }

        // are there actually files in the /src directory?
        if ($this->is_dir_empty('/src')) {
          $this->errorMsg[] = "directory for source codes is empty.";
          $this->error = true;
        }

        // is there a doxygen config file?
        if (!file_exists($this->config->doxygenDir . $this->config->doxygenConfigFile)) {
          $this->errorMsg[] = 'doxygen config file not found. Shall I <a href="?action=createDoxygenConfig">create one</a>?';
          $this->error = true;
        }

        // if no doxygen docu found, but config file exist, the run is automatically started.
        if (!file_exists($this->config->doxygenDirOut . '/html/index.html') && file_exists($this->config->doxygenDir . $this->config->doxygenConfigFile)) {
          $this->runDoxygen();
        }

        // is there a sphinx config file?
        if (!file_exists($this->config->sphinxDir . $this->config->sphinxConfigFile)) {
          $this->errorMsg[] = 'sphinx config file not found. Shall I <a href="?action=createSphinxConfig">create one</a>?';
          $this->error = true;
        }

        // is there a sphinx index file?
        if (!file_exists($this->config->sphinxDir . $this->config->sphinxIndexFile)) {
          $this->errorMsg[] = 'sphinx index file not found. Shall I <a href="?action=createSphinxIndex">create one</a>?';
          $this->error = true;
        }

        // if no sphinx docu found, but config and index file exist, the run is automatically started.
        if (!file_exists($this->config->sphinxDirOut . 'index.html') && file_exists($this->config->sphinxDir . $this->config->sphinxConfigFile) && file_exists($this->config->sphinxDir . $this->config->sphinxIndexFile)) {
          $this->runSphinxdocs();
        }




      }

      /**
       * @brief function check if a directory is empty or does not exist
       * @param string full path of directory to check
       * @retval false: if files are in folder
       * @retval true: if no files in folder or folder does not exist
       **/
      private function is_dir_empty($dirname)
      {
        // in case it does not exist return true
        if (!is_dir($dirname)) return true;
        foreach (scandir($dirname) as $file) {
          // first match returns false unless is a system file like .DS_STore
          if (!in_array($file, array('.','..','.DS_Store'))) return false;
        }
        return true;
      }

      /**
       * @brief echos errors
       **/
      private function echoErrors() {
          echo '<font color="red"><h1>SETUP ERROR</h1>';
          foreach ($this->errorMsg as $val) {
            echo "<li>$val";
          }
          echo '</font>';
      }

      /**
       * runs command and prints output
       **/
      private function outputShell($command, $title="") {
        echo '<h1>' . $title . '</h1><pre><textarea name="Text1" cols="80" rows="15">';
        $retval = system($command . " 2>&1");
//        echo '</textarea><textarea name="Text1" cols="80" rows="15">';
//        echo $retval;
        echo "</textarea></pre>";

        echo "updating complete at " . date('Y-m-d h:i:s', time());
      }
    }


    // instanciation
    $dt = new doctemplate();
 ?>
<html>
<head>
  <title>Documentation</title>
<!-- <meta http-equiv="refresh" content="5; URL=./sphinxdocs/index.html"> -->
</head>
<body>
<h1>Document generation</h1>

<table border=1>
  <tr>
    <td><a href="./">Home</a></td>
    <td><?php echo date('Y-m-d', time()); ?></td>
    <td><?php echo date('h:i:s', time()); ?></td>
  </tr>
  <tr>
    <td>Sphinxdocs</td>
    <td><a href="/docs/sphinxdocs/index.html">Show</a></td>
    <td><a href="./?action=sphinxdocs">Generate</a></td>
  </tr>
  <tr>
    <td>Doxygen</td>
    <td><a href="/docs/doxygen/html/index.html">Show</a></td>
    <td><a href="./?action=doxygen">Generate</a></td>
  </tr>
  <tr>
    <td>Debug</td>
    <td><a href="./?action=showDir">Show folder content</a></td>
    <td><a href="./?action=phpinfo">Show php info</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><a href="./pheditor.php">PhEditor</a></td>
    <td>&nbsp;</td>
  </tr>
</html>
