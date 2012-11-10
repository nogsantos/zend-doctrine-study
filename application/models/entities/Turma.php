<?php
namespace Application\Models\Entities;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="turmas")
 * 
 */
class Turma{
  /** 
   * @ORM\Id 
   * @ORM\Column(type="integer") 
   * @ORM\GeneratedValue(strategy="AUTO")
   **/
  private $id;
  /** 
   * @ORM\Column(type="string") 
   **/
  private $nome;
  /** 
   * @ORM\OneToMany(targetEntity="Aluno", mappedBy="Turma")  
   **/
  private $alunos;
  /**
   * @ORM\ManyToMany(targetEntity="Professor")
   * @ORM\JoinTable(name="professores_turma",
   * joinColumns={@ORM\JoinColumn(name="id_turma",referencedColumnName="id")},
   * inverseJoinColumns={@ORM\JoinColumn(name="id_professor",referencedColumnName="id")}
   * )
   **/
  private $professores;
}
