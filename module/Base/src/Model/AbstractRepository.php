<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 10:20
 */

namespace Base\Model;


use ArrayObject;
use Zend\Db\Adapter\Exception\InvalidQueryException;
use Zend\Db\Sql\Predicate\Operator;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Validator\Digits;


abstract class AbstractRepository{

    abstract function __construct(TableGateway $tableGateway);

    /**
     * @var $tableGateway TableGateway
     */
    protected $tableGateway;
    protected $columns;
    protected $joins;
    protected $where;
    /**
     * @var $data Result
     */
    protected $data;

    const ERROR="danger";
    const SUCCESS="success";
    const INFO="info";

    public function getTable()
    {
       return $this->tableGateway->getTable();
    }

    /**
     * @param null $where
     * @param int $page
     * @internal param array $filtro
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function select($where = null,$page=1)
    {
        $this->setData(new Result());
        $this->filtro($where);
        $data=$this->tableGateway->select($this->where);
        if($data->count()):
            $this->data->setData($data);
            $this->data->setResult($data->count());
            $this->data->setError("REGISTRO ENCOTRADO");
            $this->data->setClass(self::SUCCESS);
        else:
            $this->data->setResult(false);
            $this->data->setError("NENHUM REGISTRO ENCOTRADO");
            $this->data->setClass(self::ERROR);
        endif;

        return $this->getData();
    }
    protected function filtro($condicao){
        $this->where = new  Where();
        if(isset($condicao['asset_id']))
        {
            // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new  Operator("{$this->getTable()}.asset_id", "=",$condicao['asset_id']));
        }
        if(isset($condicao['state']) && $condicao['state']>=0)
        {
            // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new  Operator("{$this->getTable()}.state", "=",$condicao['state']));
        }
        if(isset($condicao['busca']) && !empty($condicao['busca']))
        {
            $this->where->expression("CONCAT_WS(' ', {$this->getTable()}.title, {$this->getTable()}.description) LIKE ?", "%{$condicao['busca']}%");
        }
        return  $this->where;

    }

    /**
     * @param $id
     * @return array|ArrayObject|null
     */
    public function find($id,$object=true)
    {
        $this->setData(new Result());
        $data=$this->tableGateway->select(['id'=>$id])->current();

        if($data):

        if($object){
            $this->data->setData($data->toArray());
        }
        else{
            $this->data->setData($data->toArray());
        }

        $this->data->setResult(TRUE);
        $this->data->setError("REGISTRO ENCOTRADO");
        $this->data->setClass(self::SUCCESS);

        else:
            $this->data->setResult(false);
            $this->data->setError("NENHUM REGISTRO ENCOTRADO");
            $this->data->setClass(self::ERROR);
        endif;

        return $this->getData();
    }

    /**
     * @param $where
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function findBy($where=['state'=>'0']){
        $this->setData(new Result());
        $data=$this->tableGateway->select($where);
        if($data->count()):
            $this->data->setData($data);
            $this->data->setResult($data->count());
            $this->data->setError("REGISTRO ENCOTRADO");
            $this->data->setClass(self::SUCCESS);
        else:
            $this->data->setResult(false);
            $this->data->setError("NENHUM REGISTRO ENCOTRADO");
            $this->data->setClass(self::ERROR);
        endif;
        return $this->getData();
    }

    /**
     * @param $where
     * @return array|ArrayObject|null
     */
    public function findOneBy($where,$object=true){
        $this->setData(new Result());
        $data=$this->tableGateway->select($where)->current();
        if($data->count()):
            if($object){
                $this->data->setData($data);
            }
            else{
                $this->data->setData($data->toArray());
            }
            $this->data->setResult($data->count());
            $this->data->setError("REGISTRO ENCOTRADO");
            $this->data->setClass(self::SUCCESS);
        else:
            $this->data->setResult(false);
            $this->data->setError("NENHUM REGISTRO ENCOTRADO");
            $this->data->setClass(self::ERROR);
        endif;
    }

    /**
     * @param AbstractModel $model
     * @return mixed
     */
    public function insert(AbstractModel $model)
    {
        $this->setData(new Result());
        try {
            if(empty($model->getCodigo())){
                $model->setCodigo(md5(date('YmdHis')));
            }
            if ($this->tableGateway->insert($model->toArray())):
                $this->find($this->tableGateway->getLastInsertValue(),false);
                $this->data->setLastedInsert($this->data->getData());
                $this->data->setError("O REGISTRO [ <b>{$model->getTitle()}</b> ] FOI SALVO COM SUCESSO!");
                $this->data->setResult(TRUE);
                $this->data->setClass(self::SUCCESS);
                return $this->getData();
            endif;
            $this->data->setError("Nao Foi Possivel Finalizar a Operação!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        }
        return $this->getData();
    }

    /**
     * @param AbstractModel $model
     * @param null $where
     * @return \Base\Model\Result
     */
    public function update(AbstractModel $model, $where = null)
    {
        $this->setData(new Result());
        $result=false;
        try {
            $oldData = $this->find($model->getId());
            if ($oldData) {
                if($where):
                    $result = $this->tableGateway->update($model->toArray(), [$where]);
                else:
                    $result = $this->tableGateway->update($model->toArray(), ['id' => $model->getId()]);
                endif;

                if ($result) {
                    $this->find($model->getId(),false);
                    $this->data->setError("O REGISTRO [ <b>{$model->getTitle()}</b> ] FOI ATUALIZADO COM SUCESSO!");
                    $this->data->setLastedInsert($this->data->getData());
                    $this->data->setClass(self::SUCCESS);
                    $this->data->setResult(TRUE);
                } else {
                    $this->data->setResult(FALSE);
                    $this->data->setClass(self::ERROR);
                    $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, NENHUMA ALTERAÇÃO FOI DETECTADA NO REGISTRO [ <b>{$model->getTitle()}</b> ]!");
                }
                return $this->getData();
            }
            $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, POR QUE NENHUM REGISTRO CORRESPONDENTE FOI ENCONTRADO!!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        }
        return $this->getData();

    }

    /**
     * @param $where
     * @return \Base\Model\Result
     */
    public function delete($where)
    {
        $this->setData(new Result());
        try {
            $filter=new Digits();
            if($filter->isValid($where)):
                $result = $this->tableGateway->delete(['id' =>$where]);
            else:
                $result = $this->tableGateway->delete($where);
            endif;
            if ($result) {
                $this->data->setResult(TRUE);
                $this->data->setError("O REGISTRO FOI EXCLUIDO COM SUCESSO!");
                $this->data->setClass(self::SUCCESS);
                $this->data->setLastedInsert(TRUE);
                return $this->getData();
            }

            $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, POR QUE NENHUM REGISTRO CORRESPONDENTE FOI ENCONTRADO!!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
            return $this->getData();
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
            return $this->getData();
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(Result $data)
    {
        $this->data = $data;
    }

    /**
     * @param $Name
     * @return mixed
     */
    public function StringSpace($Name)
    {
        //$var = strtolower(utf8_encode($name));
        $var = ucwords(str_replace("_", " ", $Name));
        $Name = preg_replace('{\W}', '', preg_replace('{ +}', '', strtr(
            utf8_decode(html_entity_decode($var)), utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'), 'AAAAEEIOOOUUCNaaaaeeiooouucn')));
        return $Name;
    }

}