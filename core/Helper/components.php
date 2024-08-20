<?php

// templates
const APP_TEMPLATE = <<<PHP
<?php

class %s extends Component {
    public function __construct() {
        parent::__construct();
    }
    
    public function render() {
        return view('%s', \$this->data);
    }
}
PHP;

const VIEW_TEMPLATE = <<<PHP
<div>
    <h1>%s</h1>
</div>
PHP;

// constants
const APP_PATH = BASE_PATH . "app/Components/";
const VIEW_PATH = BASE_PATH . "views/components/";

// helper functions
function getAppDir(array $path) {
    return APP_PATH . implode(
            "/",
            array_splice($path, 0, -1)
        );
}

function getViewDir(array $path) {
    return VIEW_PATH . implode(
            "/",
            array_splice($path, 0, -1)
        );
}

function getAppPath(array $path) {
    return APP_PATH . implode("/", $path) . ".php";
}

function getViewPath(array $path) {
    return VIEW_PATH . implode("/", $path) . ".view.php";
}

function getClass(array $path) {
    return $path[sizeof($path) - 1];
}

function createComponent(string $componentName) {
    // getting the path of the component for the "app" and "view" directories
    $componentAppPathArray = explode(".", $componentName);
    $componentViewPathArray = $componentAppPathArray;
    for ($i = 0; $i < sizeof($componentAppPathArray); $i++) {
        $componentAppPathArray[$i] = ucfirst($componentAppPathArray[$i]);
        $componentViewPathArray[$i] = lcfirst($componentViewPathArray[$i]);
    }

    $componentClass = getClass($componentAppPathArray);
    $componentAppPath = getAppPath($componentAppPathArray);
    $componentViewPath = getViewPath($componentViewPathArray);

    if (
        file_exists($componentAppPath) ||
        file_exists($componentViewPath)
    ) {
        echo "  * Component already exists\n";
        return;
    }

    // creating the necessary directories
    $componentAppDir = getAppDir($componentAppPathArray);
    $componentViewDir = getViewDir($componentViewPathArray);
    if (!array_key_exists("view", $_GET)) {
        if (mkdir($componentAppDir, recursive: true))
            echo "  * Directory created {$componentAppDir}\n";
    }
    if (mkdir($componentViewDir, recursive: true))
        echo "  * Directory created {$componentViewDir}\n";

    // creating the component files
    if (!array_key_exists("view", $_GET)) {
        if (file_put_contents(
            $componentAppPath,
            sprintf(APP_TEMPLATE, $componentClass, $componentName)
        ))
            echo "  * Created {$componentAppPath}\n";
    }
    if (file_put_contents(
        $componentViewPath,
        sprintf(VIEW_TEMPLATE, $componentClass)
    ))
        echo "  * Created {$componentViewPath}\n";
}

function componentsHelp() {
    echo "  * make:component [name] - creates a component\n";
    echo "      --view : create only a view file, without a class\n";
}