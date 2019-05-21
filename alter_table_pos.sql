ALTER TABLE appward_pos_live.account_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.actions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.audit_trails ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.authToken ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.banks ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.branches ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.civil_statuses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.clients ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.controllers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.customer_card_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.customer_cards ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.customer_machine_usages ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.customer_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.customers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.dealers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.discounts ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.employees ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.expenses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.expenses_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.inventories ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.inventory_categories ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.loyalty_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.loyalty_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.machine_statuses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.machine_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.machine_usage_details ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.machine_usage_headers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.machines ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.menus ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.models ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.modules ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.municipalities ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.occupations ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.payment_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.pos_payment_details ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.pos_payment_headers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.pos_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.purchases ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.raw_data ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.receipt_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.role_based_access ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.role_based_views ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.roles ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.salaries ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.service_prices ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.service_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.services ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.subscription_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.subscriptions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.suppliers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.tax_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.user_based_access ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE appward_pos_live.users ADD COLUMN is_sync INT  NOT NULL default "0";