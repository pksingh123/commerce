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

/* modules/contrib/commerce_pos/templates/commerce-pos-card-logos.html.twig */
class __TwigTemplate_bc16213c1af7079ebd60b1464324836f extends Template
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
        // line 13
        echo "<div class=\"payment-method-icon-list\">
  ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cards"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["card"]) {
            // line 15
            echo "    <span class=\"payment-method-icon payment-method-icon--";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["card"], 15, $this->source), "html", null, true);
            echo "\"></span>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['card'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce_pos/templates/commerce-pos-card-logos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 17,  46 => 15,  42 => 14,  39 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce_pos/templates/commerce-pos-card-logos.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce_pos/templates/commerce-pos-card-logos.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 14);
        static $filters = array("escape" => 15);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
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
