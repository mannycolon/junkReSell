<?php session_start();
class Cart{
    protected $cartContents = array();
    public function __construct(){
      // get the shopping cart array from the session
      $this->cartContents = !empty($_SESSION['cartContents'])?$_SESSION[cartContents]:NULL;
      if($this->cartContents === null){
        // set some base values
        $this->cartContents = array('cartTotal' => 0, 'totalItems' => 0);
      }
    }

    /**
     * Cart Contents: Returns the entire cart array
     * @param: bool
     * @return: array
     */
     public function contents(){
       // rearrange the newest first
       $cart = array_reverse($this->cartContents);
       // remove these so they don't create a problem when showing the cart table
       unset($cart['totalItems']);
       unset($cart['cartTotal']);

       return $cart;
     }

     /**
     * Get cart item: Returns a specific cart item details
     * @param: string $row_ID
     * @return: array
     */
     public function getItem($row_ID){
       return(in_array($row_ID, array('totalItems', 'cartTotal'), TRUE) OR !
              isset($this->cartContents[$row_ID]))
              ? FALSE
              : $this->cartContents[$row_ID];
     }

     /**
     * Total Items: Returns the total item count
     * @return: int
     */
     public function totalItems(){
       return $this->cartContents['totalItems'];
     }

     /**
     * Cart Total: Returns the total price
     * @return: int
     */
     public function totalPrice(){
       return $this->cartContents['cartTotal'];
     }

     /**
    * Insert items into the cart and save it to the session
    * @param: array
    * @return: bool
    */
    public function insert($item = array()){
        if(!is_array($item) OR count($item) === 0){
          return FALSE;
        }else{
          if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
            return FALSE;
          }else{
              /*
               * Insert Item
               *prep the quantity
               */
               $item['qty'] = (float) $item['qty'];
               if($item['qty'] == 0){
                  return FALSE;
               }
               // prep the price
                $item['price'] = (float) $item['price'];
                // create a unique identifier for the item being inserted into the cart
                $rowid = md5($item['id']);
                // get quantity if it's already there and add it on
                $old_qty = isset($this->cartContents[$rowid]['qty']) ? (int)
                        $this->cartContents[$rowid]['qty'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cartContents[$rowid] = $item;
                // save Cart Item
                if($this->saveCart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
          }
        }
    }

    /**
     * Update the cart
     * @param: array
     * @return: bool
     */
     public function update($item = array()){
        if(!is_array($item) OR count($item) === 0){
          return FLASE;
        }else{
          if(!isset($item['rowid'], $this->cartContents[$item['rowid']])){
            return FALSE;
          }else{
            // prep the quantity
            if(isset($item['qty'])){
              $item['qty'] = (float) $item['qty'];
              // remove the item from the cart, if quantity is zero
              if($item['qty'] == 0){
                unset($this->cartContents[$item['rowid']]);
                return TRUE;
              }
            }
            // find updatable keys
            $keys = array_intersect(array_keys($this->cartContents[$item['rowid']]), array_keys($item));
            // prep the price
            if(isset($item['price'])){
              $item['price'] = (float) $item['price'];
            }
            // product id & name shouldn't be changed
            foreach(array_dif($keys, array('id', 'name')) as $key){
              $this->cartContents[$item['rowid']][$key] = $item[$key];
            }
            // save cart data
            $this->saveCart();
            return TRUE;
          }
        }
     }

     /**
     * Save the cart array to the session
     * @return: bool
     */
      protected function saveCart(){
          $this->cartContents['totalItems'] = $this->cartContents['cartTotal'] = 0;
          foreach($this->cartContents as $key => $val){
            // make sure the array contains the proper indexes
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){
              continue;
            }
            $this->cartContents['cartTotal'] += ($val['price'] * $val['qty']);
            $this->cartContents['totalItems'] += ($val['qty'];
            $this->cartContents[$key]['subtotal'] = ($this->cartContents[$key]['price'] * $this->cartContents[$key]['qty']);
          }

          // if cart empty, delete it from the session
          if(count($this->cartContents) <= 2){
            unset($_SESSION['cartContents']);
            return FALSE;
          }else{
            $_SESSION['cartContents'] = $this->cartContents;
            return TRUE;
          }
      }

      /**
     * Remove Item: Removes an item from the cart
     * @param: int
     * @return: bool
     */
     public function remove($row_id){
        // unset & save
        unset($this->cartContents[$row_id]);
        $this->saveCart();
        return TRUE;
     }

     /**
     * Destroy the cart: Empties the cart and destroy the session
     * @return: void
     */
    public function destroy(){
        $this->cartContents = array('cartTotal' => 0, 'totalItems' => 0);
        unset($_SESSION['cartContents']);
    }
}
