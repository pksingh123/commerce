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

/* modules/contrib/commerce_pos/templates/commerce-pos-form-payment.html.twig */
class __TwigTemplate_4863ce994d6379db37b872387e466014 extends Template
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
        // line 12
        echo "<div class=\"layout-pos-form layout-pos-form-payment clearfix\">
    <div class=\"layout-region-pos-main\">
        <div class=\"layout-region layout-region-pos-content\">
            ";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null), 15, $this->source), "advanced", "actions", "totals", "mail"), "html", null, true);
        echo "
        </div>
    </div>
    <div class=\"layout-region-pos-sidebar\">
        <div class=\"layout-region layout-region-pos-totals\">
            ";
        // line 20
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "totals", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
        echo "
        </div>
        <div class=\"layout-region layout-region-pos-mail\">
            ";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "mail", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
        echo "
        </div>
        <div class=\"layout-region layout-region-pos-footer\">
            ";
        // line 26
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "actions", [], "any", false, false, true, 26), 26, $this->source), "html", null, true);
        echo "
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce_pos/templates/commerce-pos-form-payment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 26,  58 => 23,  52 => 20,  44 => 15,  39 => 12,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce_pos/templates/commerce-pos-form-payment.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce_pos/templates/commerce-pos-form-payment.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 15, "without" => 15);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'without'],
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
