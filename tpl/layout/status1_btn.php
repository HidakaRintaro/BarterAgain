<div class="content">
      <tr>
        <th colspan="2"><a class="js-modal-open" href=""><input class="btn1" name="btn" type="submit" value="交換する商品を選択"></a></th>
      </tr>
    </div>
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
        <h2>交換する商品を選択</h2>
        <br>
<?php foreach ($barter_list as $row) : ?>
        <div class="modal_body">
          <form method="post">
            <p class="modal_img"><img src="<?php echo FILE_IMG.$row['image_id'] ?>" class="image"></p>
            <p class="modal_product_name">
              <?php echo $row['name'] ?>
              <br>
              <button type="submit" class="btn1" name="request_btn" value="request_btn">申請する</button>
            </p>
            <input type="hidden" name="barter_id" value="<?php echo $row['id'] ?>">
            <input type="hidden" name="exhibit_id" value="<?php echo $product['id'] ?>">
          </form>
        </div>
<?php endforeach; ?>
        <a class="js-modal-close closeModal" href="">閉じる</a>
      </div><!--modal__inner-->
    </div><!--modal-->