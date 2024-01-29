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

/* modules/contrib/commerce_pos/templates/commerce-pos-form-order.html.twig */
class __TwigTemplate_eb6fe67ea3235874c34ebc3567f266e8 extends Template
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
        echo "<div class=\"layout-pos-form layout-pos-form-products clearfix\">
    <div class=\"layout-region-pos-main\">
        <div class=\"layout-region layout-region-pos-content\">
            ";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null), 15, $this->source), "advanced", "actions", "totals", "list", "customer", "adjustments", "coupons", "cart"), "html", null, true);
        echo "
        </div>
        <div class=\"layout-region layout-region-pos-list\">
            ";
        // line 18
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "list", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
        echo "
        </div>
    </div>
    <div class=\"layout-region-pos-sidebar\">
        <div class=\"layout-region layout-region-pos-totals\">
            ";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "totals", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
        echo "
        </div>
        <div class=\"layout-region layout-region-pos-footer\">
          <div class=\"pos-details\">
            ";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "customer", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
        echo "
            ";
        // line 28
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "adjustments", [], "any", false, false, true, 28), 28, $this->source), "html", null, true);
        echo "
            ";
        // line 29
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "coupons", [], "any", false, false, true, 29), 29, $this->source), "html", null, true);
        echo "
          </div>
            ";
        // line 31
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "actions", [], "any", false, false, true, 31), 31, $this->source), "html", null, true);
        echo "
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce_pos/templates/commerce-pos-form-order.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 31,  73 => 29,  69 => 28,  65 => 27,  58 => 23,  50 => 18,  44 => 15,  39 => 12,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce_pos/templates/commerce-pos-form-order.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce_pos/templates/commerce-pos-form-order.html.twig");
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
