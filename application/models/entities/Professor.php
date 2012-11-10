<?php
namespace Application\Models\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="professores")
 * 
 */
class Professor
{
  /** 
   * @ORM\Id 
   * @ORM\Column(type="integer") 
   * @ORM\GeneratedValue(strategy="AUTO")
   **/
  private $id;
  /**
   *  @ORM\Column(type="integer") 
   **/
  private $matricula;
  /** 
   * @ORM\Column(type="string") 
   **/  
  private $nome;
  /** 
   * @ORM\ManyToMany(targetEntity="Turma", mappedBy="professores")
   **/
  private $turmas;
}
