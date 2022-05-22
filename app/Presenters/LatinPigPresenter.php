<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\LatinPig;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

final class LatinPigPresenter extends Presenter
{
    private $result = null;

    public function renderDefault()
    {
        $this->template->result = $this->result;
    }

    private $latinPig;

    public function __construct(LatinPig $latinPig)
    {
        parent::__construct();
        $this->latinPig = $latinPig;
    }

    protected function createComponentLatinPigForm()
    {
        $form = new Form;

        $form->addText('str', 'String to translate')
             ->setHtmlType('string');
        $form->addSubmit('translate', 'translate');
        $form->onSuccess[] = [$this, 'translateFormSucc'];

        return $form;
    }

    public function translateFormSucc(Form $form, ArrayHash $values)
    {
        $this->result = $this->latinPig->translate($values->str);
    }

}
