ALTER TABLE alarcon_live.account_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.actions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.audit_trails ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.banks ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.branches ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.civil_statuses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.clients ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.controllers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.customer_card_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.customer_cards ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.customer_machine_usages ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.customer_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.customers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.dealers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.discounts ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.employees ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.expenses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.expenses_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.inventories ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.inventory_categories ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.loyalty_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.loyalty_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.machine_statuses ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.machine_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.machine_usage_details ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.machine_usage_headers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.machines ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.menus ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.models ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.modules ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.occupations ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.payment_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.pos_payment_details ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.pos_payment_headers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.pos_transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.purchases ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.raw_data ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.receipt_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.role_based_access ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.role_based_views ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.roles ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.salaries ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.service_prices ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.service_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.services ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.subscription_types ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.subscriptions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.suppliers ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.tax_settings ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.transactions ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.user_based_access ADD COLUMN is_sync INT  NOT NULL default "0";
ALTER TABLE alarcon_live.users ADD COLUMN is_sync INT  NOT NULL default "0";