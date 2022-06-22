<!DOCTYPE html>
<html>
	<title>Pager payment Integration</title>
	<head>
		<script src="https://assets.pagar.me/checkout/1.1.0/checkout.js"></script>
		<script type="text/javascript">
		window.onload=function(){

		var button = document.getElementById('payment')

button.addEventListener('click', function() {
  function handleSuccess (data) {
    console.log(data);
  }

  function handleError (data) {
    console.log(data);
  }

  var checkout = new PagarMeCheckout.Checkout({
    encryption_key: 'ek_test_diCv3gTl0CmziMBJYHndcY4xWr4oqY',
    success: handleSuccess,
    error: handleError
  });

  checkout.open({
    amount: 100,
    createToken: 'true',
    paymentMethods: 'credit_card',
    customerData: false,
    customer: {
      external_id: '#123456789',
      name: 'Fulano',
      type: 'individual',
      country: 'br',
      email: 'fulano@email.com',
      documents: [
        {
          type: 'cpf',
          number: '71404665560',
        },
      ],
      phone_numbers: ['+5511999998888', '+5511888889999'],
      birthday: '1985-01-01',
    },
    billing: {
      name: 'Ciclano de Tal',
      address: {
        country: 'br',
        state: 'SP',
        city: 'S�o Paulo',
        neighborhood: 'Fulanos bairro',
        street: 'Rua dos fulanos',
        street_number: '123',
        zipcode: '05170060'
      }
    },
    shipping: {
      name: 'Ciclano de Tal',
      fee: 12345,
      delivery_date: '2017-12-25',
      expedited: true,
      address: {
        country: 'br',
        state: 'SP',
        city: 'S�o Paulo',
        neighborhood: 'Fulanos bairro',
        street: 'Rua dos fulanos',
        street_number: '123',
        zipcode: '05170060'
      }
    },
    items: [
      {
        id: '1',
        title: 'Bola de futebol',
        unit_price: 12000,
        quantity: 1,
        tangible: true
      },
      {
        id: 'a123',
        title: 'Caderno do Goku',
        unit_price: 3200,
        quantity: 3,
        tangible: true
      }
    ]
  })
});

}
		</script>
		<style>
			body{
  background-color: #282828;
}

button{
  margin: 0;
  display: inline-block;
  padding: 10px 12px;
  background: transparent;
  border: 1px solid #92c83e;
  border-radius: 4px;
  font-size: 13px;
  font-weight: normal;
  font-family: "Titillium Web", Helvetica, Arial, sans-serif;
  text-transform: uppercase;
  text-decoration: none;
  text-align: center;
  letter-spacing: 1px;
  vertical-align: middle;
  line-height: 13px;
  color: #92c83e;
  -webkit-transition: opacity cubic-bezier(0.23, 1, 0.32, 1) 0.28s;
  transition: opacity cubic-bezier(0.23, 1, 0.32, 1) 0.28s;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

button:hover{
  background-color: #92c83e;
  border-color: #92c83e;
  color: #FFF;
}

button:active{
  background: none;
  color: #92c83e;
  margin-top: 1px;
}

button:focus{
  box-shadow: none;
}

		</style>
	</head>

	<body>		
		<button id="payment">Pagar.me</button>
		
	</body>
</html>
