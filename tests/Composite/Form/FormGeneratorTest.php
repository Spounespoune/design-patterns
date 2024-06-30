<?php

namespace App\Tests\Composite\Form;

use App\Composite\FormGenerator\Button;
use App\Composite\FormGenerator\Form;
use App\Composite\FormGenerator\Input;
use App\Composite\FormGenerator\InputComposite;
use App\Composite\FormGenerator\Label;
use App\Composite\FormGenerator\ParagraphComposite;
use PHPUnit\Framework\TestCase;

class FormGeneratorTest extends TestCase
{
    public function testFormEmpty()
    {
        $method = 'get';
        $action = 'www.google.fr';
        $class = 'form';
        $expectedFormRender = '<form method="' . $method .'" action="' . $action . '" class="' . $class . '"></form>';
        $from = new Form($method, $action, $class);
        $this->assertSame($expectedFormRender, $from->render());
    }

    public function testFormWithInput()
    {
        $method = 'get';
        $action = 'www.google.fr';
        $class = 'form';
        $type = 'text';
        $id = 'test';
        $name = 'name';
        $expectedFormRender = '<form method="' . $method .'" action="' . $action . '" class="' . $class . '"><input type="' . $type . '" id="' . $id . '" name="' . $name . '" /></form>';
        $form = new Form($method, $action, $class);
        $input = new Input($type, $id, $name);
        $form->add($input);
        $this->assertSame($expectedFormRender, $form->render());
    }

    public function testFormWithInputAndButton()
    {
        $method = 'get';
        $action = 'www.google.fr';
        $class = 'form';
        $type = 'text';
        $id = 'test';
        $name = 'name';
        $type2 = 'button';
        $value = 'valider';
        $expectedFormRender = '<form method="' . $method .'" action="' . $action . '" class="' . $class .
            '">'.'<input type="' . $type . '" id="' . $id . '" name="' . $name . '" /><input type="' . $type2 .
            '" id="' . $id . '" name="' . $name . '" value="' . $value . '" /></form>';
        $form = new Form($method, $action, $class);
        $input = new Input($type, $id, $name);
        $button = new Button($type2, $id, $name, $value);
        $form->add($input);
        $form->add($button);
        $this->assertSame($expectedFormRender, $form->render());
    }

    public function testFormWithLabelAndInput()
    {
        $method = 'get';
        $action = 'www.google.fr';
        $class = 'form';
        $type = 'text';
        $id = 'test';
        $name = 'name';
        $label = 'label';
        $expectedFormRender = '<form method="' . $method .'" action="' . $action . '" class="' . $class . '"><label for="test">'. $label .'</label><input type="' . $type . '" id="' . $id . '" name="' . $name . '" /></form>';
        $form = new Form($method, $action, $class);
        $inputComposite = new InputComposite($type, $id, $name);
        $inputComposite->add(new Label($label));
        $form->add($inputComposite);
        $this->assertSame($expectedFormRender, $form->render());
    }

    public function testFormWithLabelAndInputInP()
    {
        $method = 'get';
        $action = 'www.google.fr';
        $class = 'form';
        $type = 'text';
        $id = 'test';
        $name = 'name';
        $label = 'label';
        $expectedFormRender = '<form method="' . $method .'" action="' . $action . '" class="' . $class . '"><p><label for="test">'. $label .'</label><input type="' . $type . '" id="' . $id . '" name="' . $name . '" /></p></form>';
        $form = new Form($method, $action, $class);
        $p = new ParagraphComposite();
        $inputComposite = new InputComposite($type, $id, $name);
        $inputComposite->add(new Label($label));
        $p->add($inputComposite);
        $form->add($p);
        $this->assertSame($expectedFormRender, $form->render());
    }
}