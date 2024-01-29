<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/contrib/commerce_pos/modules/keypad/templates/commerce-pos-keypad-keypad.html.twig */
class __TwigTemplate_d45dcab4bef6651f97cbb0a4588862d3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 14
        echo "
  <div class=\"commerce-pos-keypad\">
    <div class=\"commerce-pos-keypad-keys\">
      <div class=\"commerce-pos-keypad-numbers\">
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"7\">7</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"8\">8</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"9\">9</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"4\">4</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"5\">5</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"6\">6</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"1\">1</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"2\">2</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"3\">3</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"0\">0</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"00\">00</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\"000\">000</div>
        <div class=\"commerce-pos-keypad-key\" data-keybind=\".\">.</div>
      </div>

      <div class=\"commerce-pos-keypad-actions\">
        <div class=\"commerce-pos-keypad-key\" data-key-action=\"backspace\">&lt;</div>
        <div class=\"commerce-pos-keypad-key clear-key\" data-key-action=\"clear\">C</div>
      </div>
    </div>
  </div>

";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce_pos/modules/keypad/templates/commerce-pos-keypad-keypad.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  39 => 14,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce_pos/modules/keypad/templates/commerce-pos-keypad-keypad.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce_pos/modules/keypad/templates/commerce-pos-keypad-keypad.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
