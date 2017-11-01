<?php
/**
 * alltosun.com  SiteController.class.php
 * ============================================================================
 * 版权所有 (C) 2009-2014 北京互动阳光科技有限公司，并保留所有权利。
 * 网站地址:   http://www.alltosun.com
 * ----------------------------------------------------------------------------
 * 许可声明：这是一个开源程序，未经许可不得将本软件的整体或任何部分用于商业用途及再发布。
 * ============================================================================
 * $Author: 勾国印 (gougy@alltosun.com) $
 * $Date: 2014-11-22 上午12:24:54 $
 * $Id$
*/
namespace Admin\Controller;
use Think\Controller;

class GoodsController extends AuthController {

    public function _empty($action='index')
    {
        $Goods = M('Monday');

        //$filter['status'] = 1;

        //搜索条件
		
        $search  = I('search', array());

        $title   = $search['title'];
        $brand_id   = $search['brand_id'];
        $PNO     = $search['PNO'];
        $old_PNO = $search['old_PNO'];

        if($title && isset($title)){
            $filter['title'] = array('like',"%{$title}%");
        }

        if($brand_id && isset($brand_id)){
            $filter['brand_id'] = $brand_id;
        }

        if($PNO && isset($PNO)){
            $filter['PNO'] = array('like',"%{$PNO}%");
        }

        if($old_PNO && isset($old_PNO)){
            $filter['old_PNO'] = array('like',"%{$old_PNO}%");
        }

        //分页
        $total      = $Goods->where($filter)->count();

        if($total){
            $perNum = 20;
            $Page       = new \Think\Page($total,$perNum);

            $Page->setConfig('prev', "上一页");//上一页
            $Page->setConfig('next', '下一页');//下一页
            $Page->setConfig('first', '首页');//第一页
            $Page->setConfig('last', "末页");//最后一页
            $Page -> setConfig ( 'theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );

            $show       = $Page->show();

            $this->assign('total',$total);
            $this->assign('page',$show);

        }

        $goods_list = $Goods->where($filter)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$wpjs = M('Jsh');
		$jiaoshi =  $wpjs->select();
		var_dump($goods_list);
		$i=0;
		foreach ($jiaoshi as $wp=>$v){
			$jiaoshihao['jiaoshi']=$v['jiaoshi'];
			$wsy = M('Monday')->where($jiaoshihao)->field('jsname,jieci')->select();
			foreach ($wsy as $w=>$p){
				if($p['jieci']=='1-2'){
				$one=$p['jsname'];	
					
				}
				if($p['jieci']=='11-12'){
					$wan=$p['jsname'];
					}
				}
			var_dump($wsy);echo "wp";
			$i++;
			};
			var_dump($one);die;$result = $Goods->add($info[$k-2]);
        $wp_list =  $Goods->where("jieci='1-2' or jieci='1-3' ")->select();
        if($action == 'export'){
        	if(!$goods_list){
        	    $this->error('没有搜索结果，无法导出数据');
        	}
        	$this->goods_export($goods_list);
        }
        $this->assign('search', $search);
        $this->assign('goods_list', $goods_list);
        $this->assign('wp_list', $wp_list);
        $this->display('goods_list');
		  
    }

    //添加产品
    public function add()
    {

        $this->display('goods_add');
    }

    //添加产品
    public function check_title()
    {
        $title = I('param');
        $result = check_title('goods', $title);

        if($result){
            $this->ajaxReturn(array('status' => 'n', 'info' => '该产品已经存在'));
        }else{
            $this->ajaxReturn(array('status' => 'y', 'info' => ''));
        }

    }


    //编辑类别
    public function edit()
    {
        $id = I('id');
        $goods_info = M('Goods')->find($id);

        //print_r($goods_info);

        $this->assign('goods_info', $goods_info);
        $this->display('goods_add');
    }

    //保存数据
    public function save()
    {
        $id = I('id');

        $Goods = M('Goods');
        $info = $Goods->find($id);

        $data['title']    = I('title', '');
        $data['PNO']      = I('PNO', '');
        $data['old_PNO']  = I('old_PNO', '');
        $data['price']    = I('price', '');
        $data['brand_id']    = I('brand_id', 0);
        $data['category_id'] = I('category_id', 0);

        $type_ids = I('type_ids', '');
        $data['type_ids'] = ','.$type_ids.',';

        if($info){
            //print_r($data);echo '1111';exit;
            //更新操作
            $result = $Goods->where(array('id' => $id))->save($data);
            if($result || $result === 0){
                $this->ajaxReturn(array('status' => 'ok', 'info' => '产品修改成功'));
            }else if($result === FALSE){
                $this->ajaxReturn(array('status' => 'error', 'info' => '产品修改失败'));
            }
        }else{
            //入库操作
            $data['add_time'] = date('Y-m-d H:i:s', time());

            //print_r($data);echo '2222';exit;

            $result = $Goods->add($data);
            if($result){
                $this->ajaxReturn(array('status' => 'ok', 'info' => '产品添加成功'));
            }else{
                $this->ajaxReturn(array('status' => 'error', 'info' => '产品添加失败'));
            }
        }

    }


    public function del()
    {
        $id = I('id');
        $result = M('Goods')-> delete($id);
        if($result){
            $this->success('产品删除成功,正在转跳到产品列表');
        }else if($result){
            $this->erroe('产品删除失败');
        }
    }

    //上传方法
    public function upload()
    {
        header("Content-Type:text/html;charset=utf-8");
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('xls', 'xlsx');// 设置附件上传类
        $upload->savePath  =      '/'; // 设置附件上传目录
        // 上传文件
        $info   =   $upload->uploadOne($_FILES['excelData']);
        $filename = './Uploads'.$info['savepath'].$info['savename'];
        $exts = $info['ext'];
		
        //print_r($info);exit;
        if(!$info) {// 上传错误提示错误信息
		
              $this->error($upload->getError());
          }else{// 上传成功
                  $this->goods_import($filename, $exts);
        }
    }

    //导入数据页面
    public function import()
    {
        $this->display('goods_import');
    }

    //导入数据方法
    protected function goods_import($filename, $exts='xls')
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        //创建PHPExcel对象，注意，不能少了\
        $PHPExcel=new \PHPExcel();
        //如果excel文件后缀名为.xls，导入这个类
        if($exts == 'xls'){
            import("Org.Util.PHPExcel.Reader.Excel5");
            $PHPReader=new \PHPExcel_Reader_Excel5();
        }else if($exts == 'xlsx'){
            import("Org.Util.PHPExcel.Reader.Excel2007");
            $PHPReader=new \PHPExcel_Reader_Excel2007();
        }


        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
		
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            //从哪列开始，A表示第一列
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                //数据坐标
                $address=$currentColumn.$currentRow;
                //读取到的数据，保存到数组$arr中
				//$cell = $data[$currentRow][$currentColumn];
                $data[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
                //$cell = $data[$currentRow][$currentColumn];
                if($cell instanceof PHPExcel_RichText){
                    $cell  = $cell->__toString();
                }
                
            }

        }
	//var_dump($data);	
        $this->save_import($data);
    }

    //保存导入数据
    public function save_import($data)
    {
        echo "wp";var_dump($data);
echo $Goods;
        $Goods = M('Monday');
		
        $add_time = date('Y-m-d H:i:s', time());
        foreach ($data as $k=>$v){
            if($k >= 2){
				$type_ids=$v['F'];
				if($type_ids=="一"){

                $title=$v['A'];
                $info[$k-2]['danwei'] = $title;

                $pno=$v['B'];
                $info[$k-2]['kecheng'] = $pno;

                

                $brand7=$v['D'];
                $info[$k-2]['jsname'] = $brand7;
				$price=$v['E'];
                $info[$k-2]['jiaoshi'] = $price;

                
				$category_id=$v['G'];
                $info[$k-2]['jieci'] = $category_id;

				}

               

             
                //$info[$k-2]['add_time'] = $add_time;

                    $result = $Goods->add($info[$k-2]);
                


                //print_r($info);exit;



            }

        }

        if(false !== $result || 0 !== $result){
            $this->success('产品导入成功', 'Admin/Goods/index');
        }else{
            $this->error('产品导入失败');
        }
        //print_r($info);

    }

    //导出数据方法
    protected function goods_export($goods_list=array())
    {
        //print_r($goods_list);exit;
        $goods_list = $goods_list;
        $data = array();
        foreach ($goods_list as $k=>$goods_info){
            $data[$k][id] = $goods_info['id'];
            $data[$k][title] = $goods_info['title'];
            $data[$k][PNO] = $goods_info['PNO'];
            $data[$k][old_PNO] = $goods_info['old_PNO'];
            $data[$k][price]  = $goods_info['price'];
            $data[$k][brand_id]  = get_title('brand',$goods_info['brand_id']);
            $data[$k][category_id]  = get_title('category',$goods_info['category_id']);
            $data[$k][type_ids] = get_type_title($goods_info['id']);
            $data[$k][add_time] = $goods_info['add_time'];
        }

        //print_r($goods_list);
        //print_r($data);exit;

        foreach ($data as $field=>$v){
            if($field == 'id'){
                $headArr[]='产品ID';
            }

            if($field == 'title'){
                $headArr[]='产品名称';
            }

            if($field == 'PNO'){
                $headArr[]='零件号';
            }

            if($field == 'old_PNO'){
                $headArr[]='原厂参考零件号';
            }

            if($field == 'price'){
                $headArr[]='原厂参考面价';
            }

            if($field == 'type_ids'){
                $headArr[]='品牌';
            }

            if($field == 'brand_id'){
                $headArr[]='类别';
            }
            if($field == 'category_id'){
                $headArr[]='适用机型';
            }

            if($field == 'add_time'){
                $headArr[]='添加时间';
            }
        }

        $filename="goods_list";

        $this->getExcel($filename,$headArr,$data);
    }


    private  function getExcel($fileName,$headArr,$data){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);

        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
    public function delectbiao(){

        $mondy = M('Mondy')->where('1')->delete(); //删除周一表
        $two = M('Two')->where('1')->delete(); //删除周二表
        $three = M('Three')->where('1')->delete();//删除周三表
        $four = M('Four')->where('1')->delete();//删除周四表
        $five = M('Five')->where('1')->delete();//删除周五表
        $six = M('Six')->where('1')->delete();//删除周六表
        $seven = M('Seven')->where('1')->delete();//删除周日表
        $list = $mondy+$two+$three+$four+$five+$six+$seven;
        if($list!==false) {
        $this->success("成功删除{$list}条！");
        }else{
        $this->error('删除失败！');
        }

    }
    public function delectzong(){

        $mondy = M('Goods')->where('1')->delete(); //删除总表
        if($mondy!==false) {
        $this->success("成功删除{$mondy}条！");
        }else{
        $this->error('删除失败！');
        }

    }
	public function jinming(){
		
		//教室号数组
		//$classroom = array('0'=>'2102','1'=>'2202');
		$room = M('Jiaoshihao')->field('jiaoshi')->select();
        foreach($room as $key=>$class){
            $classroom[] = $class['jiaoshi'];

        }
        //var_dump($classroom);die;
		foreach($classroom as $classkey=>$classvalue){
			$date['price'] = $classvalue; 
            $number = array('0'=>'一','1'=>'二','2'=>'三','3'=>'四','4'=>'五','5'=>'六','6'=>'日');//星期数组
            foreach($number as $key => $value) {
               $date['type_ids'] = $value;
             $good = M('Goods')->where($date)->field('type_ids,category_id,jsname')->select();
            //var_dump($good);die;
            if (!empty($good)) {
              
            foreach($good as $goodkey=>$goodvalue){
                //var_dump($goodvalue);
                $week = $goodvalue['type_ids'];
                $jieci = $goodvalue['category_id'];
                $name = $goodvalue['jsname'];
                
                //判断第几天
                if($week == '一'){
                    $weeknum = '1'; 
                }
                if($week == '二'){
                    $weeknum = '2'; 
                }
                if($week == '三'){
                    $weeknum = '3'; 
                }
                if($week == '四'){
                    $weeknum = '4'; 
                }
                if($week == '五'){
                    $weeknum = '5'; 
                }
                if($week == '六'){
                    $weeknum = '6'; 
                }
                if($week == '日'){
                    $weeknum = '7'; 
                }
                //判断第几节
                if($jieci == '1-2' or $jieci == '1-3' or $jieci == '1-4'){
                    if($jieci == '1-3'){
                       $name = $name."3";
                    }
                    elseif($jieci == '1-4'){
                      $name = $name."4";
                    }
                    $jiecinum = '1';    
                }
                if($jieci == '3-4' ){
                    $jiecinum = '2';    
                }
                if($jieci == '7-8' or $jieci == '7-9' or $jieci == '7-10'){
                     if($jieci == '7-9'){
                       $name = $name."3";
                    }
                    elseif($jieci == '7-10'){
                      $name = $name."4";
                    }
                    $jiecinum = '3';    
                }
                if($jieci == '9-10'){
                    $jiecinum = '4';    
                }
                if($jieci == '11-12' or $jieci == '11-13'){
                    $jiecinum = '5';    
                }
                
                $result[$classvalue][$weeknum][$jiecinum] = $name;
            }
            }else{
                 //判断第几天
                if($value == '一'){
                    $weeknum = '1'; 
                }
                if($value == '二'){
                    $weeknum = '2'; 
                }
                if($value == '三'){
                    $weeknum = '3'; 
                }
                if($value == '四'){
                    $weeknum = '4'; 
                }
                if($value == '五'){
                    $weeknum = '5'; 
                }
                if($value == '六'){
                    $weeknum = '6'; 
                }
                if($value == '日'){
                    $weeknum = '7'; 
                }
                $result[$classvalue][$weeknum]['1'] = "";
                $result[$classvalue][$weeknum]['2'] = "";
                $result[$classvalue][$weeknum]['3'] = "";
                $result[$classvalue][$weeknum]['4'] = "";
                $result[$classvalue][$weeknum]['5'] = "";

            }

            }
			

		}
		//var_dump($result);die;
		
		foreach($result as $resultkey=>$resultvalue){
			foreach($resultvalue as $key=>$value){
				if($key == '1'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('mondy')->add($insertdate);
                    var_dump($insert);echo '1';
				}
				if($key == '2'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('two')->add($insertdate);
                    var_dump($insert);echo '2';
				}
				if($key == '3'){
					$insertdate['classroom'] = $resultkey;
					$insertdate['one'] = isset($value['1'])?$value['1']:'';
					$insertdate['two'] = isset($value['2'])?$value['2']:' ';
					$insertdate['three'] = isset($value['3'])?$value['3']:'';
					$insertdate['four'] = isset($value['4'])?$value['4']:' ';
					$insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Three')->add($insertdate);
					var_dump($insert);echo '3';
				}
				if($key == '4'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Four')->add($insertdate);
                    var_dump($insert);echo '4';
				}
				if($key == '5'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Five')->add($insertdate);
                    var_dump($insert);echo '5';
				}
				if($key == '6'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Six')->add($insertdate);
                    var_dump($insert);echo '6';
				}
				if($key == '7'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Seven')->add($insertdate);
                    var_dump($insert);echo '7';
				}
			}
		}
	}
		public function minglun(){
		
		//教室号数组
		//$classroom = array('0'=>'2102','1'=>'2202');
		$room = M('mljs')->field('jiaoshi')->select();
        foreach($room as $key=>$class){
            $classroom[] = $class['jiaoshi'];

        }
        //var_dump($classroom);die;
		foreach($classroom as $classkey=>$classvalue){
			$date['price'] = $classvalue; 
            $number = array('0'=>'一','1'=>'二','2'=>'三','3'=>'四','4'=>'五','5'=>'六','6'=>'日');//星期数组
            foreach($number as $key => $value) {
               $date['type_ids'] = $value;
             $good = M('Goods')->where($date)->field('type_ids,category_id,jsname')->select();
            //var_dump($good);die;
            if (!empty($good)) {
              
            foreach($good as $goodkey=>$goodvalue){
                //var_dump($goodvalue);
                $week = $goodvalue['type_ids'];
                $jieci = $goodvalue['category_id'];
                $name = $goodvalue['jsname'];
                
                //判断第几天
                if($week == '一'){
                    $weeknum = '1'; 
                }
                if($week == '二'){
                    $weeknum = '2'; 
                }
                if($week == '三'){
                    $weeknum = '3'; 
                }
                if($week == '四'){
                    $weeknum = '4'; 
                }
                if($week == '五'){
                    $weeknum = '5'; 
                }
                if($week == '六'){
                    $weeknum = '6'; 
                }
                if($week == '日'){
                    $weeknum = '7'; 
                }
                //判断第几节
                if($jieci == '1-2' or $jieci == '1-3' or $jieci == '1-4'){
                    if($jieci == '1-3'){
                       $name = $name."3";
                    }
                    elseif($jieci == '1-4'){
                      $name = $name."4";
                    }
                    $jiecinum = '1';    
                }
                if($jieci == '3-4' ){
                    $jiecinum = '2';    
                }
                if($jieci == '7-8' or $jieci == '7-9' or $jieci == '7-10'){
                     if($jieci == '7-9'){
                       $name = $name."3";
                    }
                    elseif($jieci == '7-10'){
                      $name = $name."4";
                    }
                    $jiecinum = '3';    
                }
                if($jieci == '9-10'){
                    $jiecinum = '4';    
                }
                if($jieci == '11-12' or $jieci == '11-13'){
                    $jiecinum = '5';    
                }
                
                $result[$classvalue][$weeknum][$jiecinum] = $name;
            }
            }else{
                 //判断第几天
                if($value == '一'){
                    $weeknum = '1'; 
                }
                if($value == '二'){
                    $weeknum = '2'; 
                }
                if($value == '三'){
                    $weeknum = '3'; 
                }
                if($value == '四'){
                    $weeknum = '4'; 
                }
                if($value == '五'){
                    $weeknum = '5'; 
                }
                if($value == '六'){
                    $weeknum = '6'; 
                }
                if($value == '日'){
                    $weeknum = '7'; 
                }
                $result[$classvalue][$weeknum]['1'] = "";
                $result[$classvalue][$weeknum]['2'] = "";
                $result[$classvalue][$weeknum]['3'] = "";
                $result[$classvalue][$weeknum]['4'] = "";
                $result[$classvalue][$weeknum]['5'] = "";

            }

            }
			

		}
		//var_dump($result);die;
		
		foreach($result as $resultkey=>$resultvalue){
			foreach($resultvalue as $key=>$value){
				if($key == '1'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('mondy')->add($insertdate);
                    var_dump($insert);echo '1';
				}
				if($key == '2'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('two')->add($insertdate);
                    var_dump($insert);echo '2';
				}
				if($key == '3'){
					$insertdate['classroom'] = $resultkey;
					$insertdate['one'] = isset($value['1'])?$value['1']:'';
					$insertdate['two'] = isset($value['2'])?$value['2']:' ';
					$insertdate['three'] = isset($value['3'])?$value['3']:'';
					$insertdate['four'] = isset($value['4'])?$value['4']:' ';
					$insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Three')->add($insertdate);
					var_dump($insert);echo '3';
				}
				if($key == '4'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Four')->add($insertdate);
                    var_dump($insert);echo '4';
				}
				if($key == '5'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Five')->add($insertdate);
                    var_dump($insert);echo '5';
				}
				if($key == '6'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Six')->add($insertdate);
                    var_dump($insert);echo '6';
				}
				if($key == '7'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Seven')->add($insertdate);
                    var_dump($insert);echo '7';
				}
			}
		}
	}
    
		public function mlshl(){
		
		//明伦教室号数组
		//$classroom = array('0'=>'2102','1'=>'2202');
		$room = M('mljsshl')->field('jiaoshi')->select();
        foreach($room as $key=>$class){
            $classroom[] = $class['jiaoshi'];

        }
        //var_dump($classroom);die;
		foreach($classroom as $classkey=>$classvalue){
			$date['price'] = $classvalue; 
            $number = array('0'=>'一','1'=>'二','2'=>'三','3'=>'四','4'=>'五','5'=>'六','6'=>'日');//星期数组
            foreach($number as $key => $value) {
               $date['type_ids'] = $value;
             $good = M('Goods')->where($date)->field('type_ids,category_id,jsname')->select();
            //var_dump($good);die;
            if (!empty($good)) {
              
            foreach($good as $goodkey=>$goodvalue){
                //var_dump($goodvalue);
                $week = $goodvalue['type_ids'];
                $jieci = $goodvalue['category_id'];
                $name = $goodvalue['jsname'];
                
                //判断第几天
                if($week == '一'){
                    $weeknum = '1'; 
                }
                if($week == '二'){
                    $weeknum = '2'; 
                }
                if($week == '三'){
                    $weeknum = '3'; 
                }
                if($week == '四'){
                    $weeknum = '4'; 
                }
                if($week == '五'){
                    $weeknum = '5'; 
                }
                if($week == '六'){
                    $weeknum = '6'; 
                }
                if($week == '日'){
                    $weeknum = '7'; 
                }
                //判断第几节
                if($jieci == '1-2' or $jieci == '1-3' or $jieci == '1-4'){
                    if($jieci == '1-3'){
                       $name = $name."3";
                    }
                    elseif($jieci == '1-4'){
                      $name = $name."4";
                    }
                    $jiecinum = '1';    
                }
                if($jieci == '3-4' ){
                    $jiecinum = '2';    
                }
                if($jieci == '7-8' or $jieci == '7-9' or $jieci == '7-10'){
                     if($jieci == '7-9'){
                       $name = $name."3";
                    }
                    elseif($jieci == '7-10'){
                      $name = $name."4";
                    }
                    $jiecinum = '3';    
                }
                if($jieci == '9-10'){
                    $jiecinum = '4';    
                }
                if($jieci == '11-12' or $jieci == '11-13'){
                    $jiecinum = '5';    
                }
                
                $result[$classvalue][$weeknum][$jiecinum] = $name;
            }
            }else{
                 //判断第几天
                if($value == '一'){
                    $weeknum = '1'; 
                }
                if($value == '二'){
                    $weeknum = '2'; 
                }
                if($value == '三'){
                    $weeknum = '3'; 
                }
                if($value == '四'){
                    $weeknum = '4'; 
                }
                if($value == '五'){
                    $weeknum = '5'; 
                }
                if($value == '六'){
                    $weeknum = '6'; 
                }
                if($value == '日'){
                    $weeknum = '7'; 
                }
                $result[$classvalue][$weeknum]['1'] = "";
                $result[$classvalue][$weeknum]['2'] = "";
                $result[$classvalue][$weeknum]['3'] = "";
                $result[$classvalue][$weeknum]['4'] = "";
                $result[$classvalue][$weeknum]['5'] = "";

            }

            }
			

		}
		//var_dump($result);die;
		
		foreach($result as $resultkey=>$resultvalue){
			foreach($resultvalue as $key=>$value){
				if($key == '1'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('mondy')->add($insertdate);
                    var_dump($insert);echo '1';
				}
				if($key == '2'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('two')->add($insertdate);
                    var_dump($insert);echo '2';
				}
				if($key == '3'){
					$insertdate['classroom'] = $resultkey;
					$insertdate['one'] = isset($value['1'])?$value['1']:'';
					$insertdate['two'] = isset($value['2'])?$value['2']:' ';
					$insertdate['three'] = isset($value['3'])?$value['3']:'';
					$insertdate['four'] = isset($value['4'])?$value['4']:' ';
					$insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Three')->add($insertdate);
					var_dump($insert);echo '3';
				}
				if($key == '4'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Four')->add($insertdate);
                    var_dump($insert);echo '4';
				}
				if($key == '5'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Five')->add($insertdate);
                    var_dump($insert);echo '5';
				}
				if($key == '6'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Six')->add($insertdate);
                    var_dump($insert);echo '6';
				}
				if($key == '7'){
					$insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
					$insert = M('Seven')->add($insertdate);
                    var_dump($insert);echo '7';
				}
			}
		}
	}
        public function jmzxz(){
        
        //曾宪梓教室号数组
        //$classroom = array('0'=>'2102','1'=>'2202');
        $room = M('jmzxz')->field('jiaoshi')->select();
        foreach($room as $key=>$class){
            $classroom[] = $class['jiaoshi'];

        }
        //var_dump($classroom);die;
        foreach($classroom as $classkey=>$classvalue){
            $date['price'] = $classvalue; 
            $number = array('0'=>'一','1'=>'二','2'=>'三','3'=>'四','4'=>'五','5'=>'六','6'=>'日');//星期数组
            foreach($number as $key => $value) {
               $date['type_ids'] = $value;
             $good = M('Goods')->where($date)->field('type_ids,category_id,jsname')->select();
            //var_dump($good);die;
            if (!empty($good)) {
              
            foreach($good as $goodkey=>$goodvalue){
                //var_dump($goodvalue);
                $week = $goodvalue['type_ids'];
                $jieci = $goodvalue['category_id'];
                $name = $goodvalue['jsname'];
                
                //判断第几天
                if($week == '一'){
                    $weeknum = '1'; 
                }
                if($week == '二'){
                    $weeknum = '2'; 
                }
                if($week == '三'){
                    $weeknum = '3'; 
                }
                if($week == '四'){
                    $weeknum = '4'; 
                }
                if($week == '五'){
                    $weeknum = '5'; 
                }
                if($week == '六'){
                    $weeknum = '6'; 
                }
                if($week == '日'){
                    $weeknum = '7'; 
                }
                //判断第几节
                if($jieci == '1-2' or $jieci == '1-3' or $jieci == '1-4'){
                    if($jieci == '1-3'){
                       $name = $name."3";
                    }
                    elseif($jieci == '1-4'){
                      $name = $name."4";
                    }
                    $jiecinum = '1';    
                }
                if($jieci == '3-4' ){
                    $jiecinum = '2';    
                }
                if($jieci == '7-8' or $jieci == '7-9' or $jieci == '7-10'){
                     if($jieci == '7-9'){
                       $name = $name."3";
                    }
                    elseif($jieci == '7-10'){
                      $name = $name."4";
                    }
                    $jiecinum = '3';    
                }
                if($jieci == '9-10'){
                    $jiecinum = '4';    
                }
                if($jieci == '11-12' or $jieci == '11-13'){
                    $jiecinum = '5';    
                }
                
                $result[$classvalue][$weeknum][$jiecinum] = $name;
            }
            }else{
                 //判断第几天
                if($value == '一'){
                    $weeknum = '1'; 
                }
                if($value == '二'){
                    $weeknum = '2'; 
                }
                if($value == '三'){
                    $weeknum = '3'; 
                }
                if($value == '四'){
                    $weeknum = '4'; 
                }
                if($value == '五'){
                    $weeknum = '5'; 
                }
                if($value == '六'){
                    $weeknum = '6'; 
                }
                if($value == '日'){
                    $weeknum = '7'; 
                }
                $result[$classvalue][$weeknum]['1'] = "";
                $result[$classvalue][$weeknum]['2'] = "";
                $result[$classvalue][$weeknum]['3'] = "";
                $result[$classvalue][$weeknum]['4'] = "";
                $result[$classvalue][$weeknum]['5'] = "";

            }

            }
            

        }
        //var_dump($result);die;
        
        foreach($result as $resultkey=>$resultvalue){
            foreach($resultvalue as $key=>$value){
                if($key == '1'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('mondy')->add($insertdate);
                    var_dump($insert);echo '1';
                }
                if($key == '2'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('two')->add($insertdate);
                    var_dump($insert);echo '2';
                }
                if($key == '3'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('Three')->add($insertdate);
                    var_dump($insert);echo '3';
                }
                if($key == '4'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('Four')->add($insertdate);
                    var_dump($insert);echo '4';
                }
                if($key == '5'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('Five')->add($insertdate);
                    var_dump($insert);echo '5';
                }
                if($key == '6'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('Six')->add($insertdate);
                    var_dump($insert);echo '6';
                }
                if($key == '7'){
                    $insertdate['classroom'] = $resultkey;
                    $insertdate['one'] = isset($value['1'])?$value['1']:'';
                    $insertdate['two'] = isset($value['2'])?$value['2']:' ';
                    $insertdate['three'] = isset($value['3'])?$value['3']:'';
                    $insertdate['four'] = isset($value['4'])?$value['4']:' ';
                    $insertdate['five'] = isset($value['5'])?$value['5']:'';
                    $insert = M('Seven')->add($insertdate);
                    var_dump($insert);echo '7';
                }
            }
        }
    }
}