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

/* modules/contrib/commerce_pos/modules/receipt/templates/commerce-pos-receipt.html.twig */
class __TwigTemplate_e046be21fb6d15d0ec429e3a364a0e3c extends Template
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
        echo "
";
        // line 13
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("commerce_pos_receipt/receipt"), "html", null, true);
        echo "
";
        // line 14
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("commerce_pos_print/jQuery.print"), "html", null, true);
        echo "
<div class=\"commerce-pos-receipt\">
    <div class=\"receipt-print\">";
        // line 16
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "print", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
        echo "</div>
    <div class=\"receipt-header\">";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "header", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        echo "</div>
    <h4 class=\"receipt-title\">";
        // line 18
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "title", [], "any", false, false, true, 18), 18, $this->source), "html", null, true);
        echo "</h4>
    <div class=\"receipt-body\">";
        // line 19
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "body", [], "any", false, false, true, 19), 19, $this->source), "html", null, true);
        echo "</div>
    <div class=\"receipt-footer\">";
        // line 20
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "footer", [], "any", false, false, true, 20), 20, $this->source), "html", null, true);
        echo "</div>
    ";
        // line 21
        if (twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "cashier", [], "any", false, false, true, 21)) {
            // line 22
            echo "      <div class=\"receipt-cashier\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Cashier:"));
            echo " ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "cashier", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo "</div>
    ";
        }
        // line 24
        echo "    <div class=\"receipt-timestamp\">";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["receipt"] ?? null), "timestamp", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo "</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce_pos/modules/receipt/templates/commerce-pos-receipt.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 24,  73 => 22,  71 => 21,  67 => 20,  63 => 19,  59 => 18,  55 => 17,  51 => 16,  46 => 14,  42 => 13,  39 => 12,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce_pos/modules/receipt/templates/commerce-pos-receipt.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce_pos/modules/receipt/templates/commerce-pos-receipt.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 21);
        static $filters = array("escape" => 13, "t" => 22);
        static $functions = array("attach_library" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 't'],
                ['attach_library']
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
