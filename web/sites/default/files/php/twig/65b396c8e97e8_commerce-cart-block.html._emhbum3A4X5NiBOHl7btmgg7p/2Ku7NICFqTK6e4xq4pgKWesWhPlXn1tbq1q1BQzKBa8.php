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

/* modules/contrib/commerce/modules/cart/templates/commerce-cart-block.html.twig */
class __TwigTemplate_2d0860434f4805cb7f22e984422befb9 extends Template
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
        // line 1
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 1, $this->source), "html", null, true);
        echo ">
  <div class=\"cart-block--summary\">
    <a class=\"cart-block--link__expand\" href=\"";
        // line 3
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["url"] ?? null), 3, $this->source), "html", null, true);
        echo "\">
      <span class=\"cart-block--summary__icon\">";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["icon"] ?? null), 4, $this->source), "html", null, true);
        echo "</span>
      <span class=\"cart-block--summary__count\">";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["count_text"] ?? null), 5, $this->source), "html", null, true);
        echo "</span>
    </a>
  </div>
  ";
        // line 8
        if (($context["content"] ?? null)) {
            // line 9
            echo "  <div class=\"cart-block--contents\">
    <div class=\"cart-block--contents__inner\">
      <div class=\"cart-block--contents__items\">
        ";
            // line 12
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 12, $this->source), "html", null, true);
            echo "
      </div>
      <div class=\"cart-block--contents__links\">
        ";
            // line 15
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["links"] ?? null), 15, $this->source), "html", null, true);
            echo "
      </div>
    </div>
  </div>
  ";
        }
        // line 20
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/commerce/modules/cart/templates/commerce-cart-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 20,  72 => 15,  66 => 12,  61 => 9,  59 => 8,  53 => 5,  49 => 4,  45 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/commerce/modules/cart/templates/commerce-cart-block.html.twig", "/Applications/MAMP/htdocs/Drupal/drupaltest/web/modules/contrib/commerce/modules/cart/templates/commerce-cart-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 8);
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
