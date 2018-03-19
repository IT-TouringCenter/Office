<?php namespace App\Repositories\Src\Eloquent;

use App\Repositories\Src\Contracts\IRepository;

use App\Repositories\Src\Contracts\ICriteria;
use APp\Repositories\Src\Criteria\Criteria;
use App\Repositories\Src\Exception\RepositoryException;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

abstract class Repository implements IRepository{
	/*
	@var app
	 */
	private $app;

	/*
	@var model
	 */
	protected $model;

	/*
	 *@var
	 */
	protected $criteria;
	/*
	 *@var
	 */
	protected $skipCriteria = false;

	public function __construct(App $app){//, Collection $collection){
		$this->app=$app;
		//$this->criteria= $collection;
		$this->MakeModel();
	}

	/*
	Specify Model class name
	@return mixed
	*/
	abstract  function model();
	
	/*
		@param array $columns
		@return mixed 
	*/
 public function all($columns = array('*')){
	return $this->model->where('is_active','=',1)->get($columns);
 }

/*
	@param $groupBy
	@param array $columns
	@return mixed 
*/ 

 public function groupBy($groupBy,$columns = array('*')){
	return $this->model->where('is_active','=',1)->groupBy($groupBy)->get($columns);
 }

 /*
 * @param nit $perPage
 * @param array $columns
 * @return mixed 
 */
 public function paginate($perPage=15, $columns= array('*')){
	return $this->model->paginate($perPage,$columns);
 }

/**
   * @param array $data
   * @return mixed
   */
  public function create(array $data) {
      return $this->model->create($data);
  }

 /*
 * @param array data
 * @param @id
 * @param string $attribute
 * @return mixed
 */
 public function update(array $data, $id, $attribute = "id"){
	return $this->model->where($attribute,'=',$id)->update($data);
 }

 /*
 * @param $id
 * @return mixed
 */
 public function delete($id){
	return $this->model->destroy($id);
 }

 /*
 * @param $id
 * param array $columns
 * @return mixed
 */
 public function find($id,$columns=array('*')){
	return $this->model->find($id,$columns)->where('is_active','=',1);
 }

 /*
 * @param $attribute
 * @param $value
 * @param array $columns
 * @return mixed
 */
 public function findBy($attribute, $value, $columns=array('*')){
	return $this->model->where('is_active','=',1)->where($attribute,'=',$value)->get($columns);
 }

 /*
 * @param $attribute
 * @param $value
 * @param array $columns
 * @param $groupBy
 * @return mixed
 */
 public function findBygroupBy($attribute, $value, $groupBy, $columns=array('*')){
	return $this->model->where('is_active','=',1)->where($attribute,'=',$value)->groupBy($groupBy)->get($columns);
 }
 
	/*
	@return Model
	@throws RepositoryException
	*/ 
	public function MakeModel(){
		$model = $this->app->make($this->model());

		if(!$model instanceof Model){
			throw new RepositoryException("Class {this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
	}
	
	return $this->model = $model;
 }

 /*
	* @return $this
	*/
 public function resetScope(){
	$this->skipCriteria(false);
	return $this;
 }

 /*
	* @param bool $status
	* @return $this
	*/
 public function skipCriteria($status=true){
	$this->skipCriteria = $status;
	return $this;
 }

 public function getCriteria(){
	return $this->criteria;
 }

 public function getByCriteria(Criteria $criteria){
 	$this->model = $criteria->apply($this->model,$this);
 }

 public function pushCriteria(Criteria $criteria){
 	$this->criteria->push($criteria);
 	return $this;
 }

 public function applyCriteria(){
 	if($this->skipCriteria==true)
 		return $this;

 	foreach ($this->getCriteria() as $criteria) {
 		if($criteria instanceof Criteria)
 			$this->model = $criteria->apply($this->model,$this);
 	}
 }
}
