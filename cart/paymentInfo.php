
<?php require_once('../util/main.php'); ?>
<?php require_once('../util/userSession.php'); ?>
<?php include '../view/header.php'; ?>

    <div class="creditCardForm">
      <div class="heading">
          <h1>Confirm Purchase</h1>
      </div>
      <div class="payment">
          <form action="paymentProcessing.php" method="POST">
              <div class="form-group owner">
                  <label for="owner">Name</label>
                  <input type="text" name="cardFullName" class="form-control" id="owner"
                         title="Please enter your fullname as it appears on your card" required>
              </div>
              <div class="form-group CVV">
                  <label for="cvv">CVV</label>
                  <input type="number" class="form-control" id="cvv" name="cvv" min="3"
                         title="Please enter your card security code" required>
              </div>
              <div class="form-group" id="card-number-field">
                  <label for="cardNumber">Card Number</label>
                  <input type="number" class="form-control" id="cardNumber" min="15" name="cardNumber"
                         title="Please enter your credit Card number" required>
              </div>
              <div class="form-group" id="expiration-date">
                  <label>Expiration Date</label>
                  <select name="cardMonth" required>
                      <option disabled selected value></option>
                      <option value="01">January</option>
                      <option value="02">February </option>
                      <option value="03">March</option>
                      <option value="04">April</option>
                      <option value="05">May</option>
                      <option value="06">June</option>
                      <option value="07">July</option>
                      <option value="08">August</option>
                      <option value="09">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                  </select>
                  <select name="cardYear" required>
                      <option disabled selected value></option>
                      <option value="2016"> 2016</option>
                      <option value="2017"> 2017</option>
                      <option value="2018"> 2018</option>
                      <option value="2019"> 2019</option>
                      <option value="2020"> 2020</option>
                      <option value="2021"> 2021</option>
                      <option value="2021"> 2022</option>
                  </select>
              </div>
              <div class="form-group" id="credit_cards">
                  <img src="./images/visa.jpg" id="visa">
                  <img src="./images/mastercard.jpg" id="mastercard">
                  <img src="./images/amex.jpg" id="amex">
              </div>
              <div class="form-group" id="pay-now">
                  <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
              </div>
          </form>
      </div>
    </div>
  </body>
</html>
