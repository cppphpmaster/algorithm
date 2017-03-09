<?php
/*
	分别用
	冒泡排序
	快速排序
	选择排序
	插入排序
	将$arr中的值按照从小到大的顺序进行排序
*/
class SortingAlgorithm {
	private $arr = array();

	public function __construct($arr = array()) {
		$this->arr = $arr;
	}

	/**
		冒泡排序
		思路：在要排序的一组数中，对当前还未排好的序列，
		从前往后对相邻的两个数依次进行比较和调整，
		让较大的数往下沉，较小的往上冒。
		即：每当两相邻的数比较后发现他们的排序与排序要求相反时，就将他们互换。
		@param array
		@return array
	*/
	public function bubbleSort($arr) {
		$len = count($arr);
		//该层循环控制 需要冒泡的轮数
		for($i=1; $i<$len; ++$i) {
			//该层循环用来控制每轮 冒出一个数 需要比较的次数
			for($k=0; $k<$len-$i; ++$k) {
				if($arr[$k] > $arr[$k + 1]) {
					$tmp = $arr[$k];
					$arr[$k] = $arr[$k + 1];
					$arr[$k + 1] = $tmp;
				}
			}
		}
		return $arr;
	}


	/**
		选择排序
		思路：在要排序的一组数中，选出最小的一个数与第一个位置的数互换。
		然后在剩下的数中再找最小的与第二个位置的数互换，
		如此循环到倒数第二个数和最后一个数比较为止。
		@param array
		@return array
	*/
	public function selectSort($arr) {
		//双重循环完成，外层控制轮数，内层控制比较次数
		$len = count($arr);
		for($i=0; $i<$len-1; ++$i) {
			//先假设最小的值的位置
			$p = $i;

			for($j=$i+1; $j<$len; ++$j) {
				//$arr[$p]是当前已知的最小值
				//比较，发现更小的，记录下最小值的位置；
				//并且在下次比较时采用已知的最小值进行比较
				if($arr[$p] > $arr[$j]) {
					$p = $j;
				}
			}

			//已经确定了当前的最小值的位置，保存到$p中
			//如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可
			if($p != $i) {
				$tmp = $arr[$p];
				$arr[$p] = $arr[$i];
				$arr[$i] = $tmp;
			}
		}

		return $arr;
	}


	/**
		插入排序
		在要排序的一组数中，假设前面的数已经是排好顺序的，
		现在要把第n个数查到前面的有序数中，使得这n个数也是排好顺序的。
		如此反复循环，知道全部排好顺序
		@param array
		@reurn array
	*/
	public function insertSort($arr) {
		$len = count($arr);
		for($i=1; $i<$len; ++$i) {
			$tmp = $arr[$i];
			//内层循环控制，比较并插入
			for($j=$i-1; $j>0; --$j) {
				if($tmp < $arr[$j]) {
					//发现插入的元素要小，交换位置，将后边的元素与前面的元素互换
					$arr[$j + 1] = $arr[$j];
					$arr[$j] = $tmp;
				} else {
					//如果碰到不需要移动的元素，由于是已经排序好的数组，则前面的就不需要再次比较了
					break;
				}
			}
		}
		return $arr;
	}


	/**
		快速排序
		思路：选择一个基准元素，通常选择第一个元素或者最后一个元素。
		通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，一部分大于基准元素。
		此时基准元素在其排序好的正确位置，然后再用同样的方法递归的排序划分的两部分
		@param array
		@return array
	*/
	public function quickSort($arr) {
		//先判断是否需要继续进行
		$len = count($arr);
		if($len <= 1) {
			return $arr;
		}
		//选择第一个元素作为基准
		$baseNum = $arr[0];
		//遍历除了标尺外的所有元素，按照大小关系放入了两个数组内
		//初始化两个数组
		$leftArray = array();//小于基准的
		$rightArray = array();//大于基准的
		for($i=1; $i<$len; ++$i) {
			if($baseNum > $arr[$i]) {//放入左边数组
				$leftArray[] = $arr[$i];
			} else {//放入右边数组
				$rightArray[] = $arr[$i];
			}
		}
		//在分别对左边和右边的数组进行相同的排序处理方法递归调用这个函数
		$leftArray = $this->quickSort($leftArray);
		$rightArray = $this->quickSort($rightArray);
		//合并
		return array_merge($leftArray, array($baseNum), $rightArray);
	}
}


//test
$arr = array(1,43,54,62,21,66,32,78,36,76,39);
$sortingAlgorithm = new SortingAlgorithm();
$reusltArr = $sortingAlgorithm->quickSort($arr);
print_r($reusltArr);