<?php 

class Finalmodule extends Module {

    public function __construct()
    {
        $this->name = 'finalmodule';
        $this->tab = "front_office_features";
        $this->version = "1.0.0";
        $this->author = "yassine ABKAL";
        $this->ps_versions_compliancy = [
            "min" => "1.6",
            "max" => _PS_VERSION_
        ];

        parent::__construct();
        $this->bootstrap = true;
        $this->displayName = $this->l("finalmodule");
        $this->description = $this->l("j'aime le chocolat");
    }


        public function install()
        {
            if(!parent::install()  ||
            !Configuration::updateValue('ANNEE', 2023)  ||
            !Configuration::updateValue('MOIS', 02) ||
            !$this->createTable())
            {return false;}
            return true;
        } 
        

        public function Uninstall()
        {
            if(!parent::install()  ||
            !Configuration::deleteByName('ANNEE')  ||
            !Configuration::deleteByName('MOIS') ||
            !$this->deleteTable())
            {
                return false;
            }

            return true;

        }

        
    public function getContent()
    {

        return $this->PostProcess().$this->renderForm();
    }


    
    public function renderForm()
    {

        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings')
            ],
            'input' => [
                
                'type' => 'text',
                'label' => $this->l('Modifier l\'annee'),
                'name' => 'ANNEE',
                'required' => true
            ],
            [
                'type' => 'text',
                'label' => $this->l('Modifier le mois'),
                'name' => 'mois',
                'required' => true
            ],
            'submit' => [
                'title'=> $this->l('save'),
                'name' => 'save',
                'class' => 'btn btn-primary'
            ]
            ];

            $helper = new HelperForm();   
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;  
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->fields_value['ANNEE'] = Configuration::get('ANNEE');
        $helper->fields_value['MOIS'] = Configuration::get('MOIS');

        return $helper->generateForm($fieldsForm);
              




}
echo "je suis une licorne";