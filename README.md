## Food order and delivery application
The system is designed to fully support the operation of a coffee supply chain.

Use "deliveroo.sql" to load the database.
User categories: Admin, customer, delivery guy and store manager.

Admin:The system administrator registers all of its chain stores. For
each store, the manager registers the name of the store (eg "Notara Store"), 
his address, the store phone and his location (lat, long). Also, for each
store, the manager declares a manager who manages his reserve products.

Customer:Every client can create a new account on the system. To create a new account,
you'll need an email, desired password, and his/her phone.
Then the customer will be able to submit a new one order.

Store manager:The manager of each store connects to the system with a username/password
that is given by the administrator. The manager should be able to update the reserve
of the store for each of the 5 kinds of meals. Also, the manager will be able to
see the orders assigned for the store and pending deliveries.

Delivery guy:The distributors do not belong to a specific store but
serve all of them. When an order is placed by the system automatically the distributor
is informed by which store he/she will have to receive the order as well as for
the location of the customer who posted the order. Once the distributor has 
delivered the order, the order status turns "Delivered" and he/she is 
now available for next order.

