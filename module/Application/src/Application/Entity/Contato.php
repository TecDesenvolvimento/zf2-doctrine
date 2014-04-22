<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Exception\InvalidArgumentException;

/**
 * @ORM\Entity
 * @ORM\Table(name="tbl_contatos")
 */
class Contato implements InputFilterAwareInterface {

    /**
     * @var int
     * @access protected
     *
     * @ORM\Id
     * @ORM\Column(type="integer", name="id_contato")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @access protected
     *
     * @ORM\Column(type="string", length=40, nullable=false)
     */
    protected $nome;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    /**
     * Filters
     * 
     * @var InputFilter
     */
    protected $inputFilter = null;

    /**
     * Configura os filtros dos campos da entidade
     *
     * @return Zend\InputFilter\InputFilter
     */
    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'nome',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));


            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter) {
        
    }

}
