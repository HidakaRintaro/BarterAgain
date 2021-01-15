<tr>
  <form method="post">
    <td></td>
    <td class="status2">
      <div class="content">
        <a class="js-modal1-open" href=""><input class="btn1" name="btn" type="submit" value="承諾"></a>
      </div>
      <div class="modal js-modal1">
        <div class="modal__bg js-modal1-close"></div>
        <div class="modal__content">
          <h2>下記の商品との交換を承諾しますか？</h2>
          <br>
          <div class="modal_body">
            <form method="post">
              <p class="modal_img"><img src="<?php echo FILE_IMG.$exhibit['image_id'] ?>" class="image"></p>
              <p class="modal_product_name">
                <?php echo $exhibit['name'] ?>
                <br>
                <button type="submit" class="btn1" name="request_btn" value="ok">承諾する</button>
                <input type="hidden" name="exhibit" value="<?php echo $exhibit['id'] ?>">
                <input type="hidden" name="barter" value="<?php echo $barter['id'] ?>">
              </p>
            </form>
          </div>
          <a class="js-modal1-close closeModal" href="">閉じる</a>
        </div><!--modal__inner-->
      </div><!--modal-->

      <div class="content">
        <a class="js-modal2-open" href=""><input class="btn2" name="btn" type="submit" value="拒否"></a>
      </div>
      <div class="modal js-modal2">
        <div class="modal__bg js-modal2-close"></div>
        <div class="modal__content">
          <h2>下記の商品との交換を拒否しますか？</h2>
          <br>
          <div class="modal_body">
            <form method="post">
              <p class="modal_img"><img src="<?php echo FILE_IMG.$exhibit['image_id'] ?>" class="image"></p>
              <p class="modal_product_name">
                <?php echo $exhibit['name'] ?>
                <br>
                <button type="submit" class="btn2" name="request_btn" value="ng">拒否する</button>
              </p>
            </form>
          </div>
          <a class="js-modal2-close closeModal" href="">閉じる</a>
        </div><!--modal__inner-->
      </div><!--modal-->
    </td>
    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
  </form>
</tr>

