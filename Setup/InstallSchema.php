<?php
namespace Ibnab\Additional\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        
        $setup->getConnection()->addColumn(
            $setup->getTable('quote_payment'),
            'bankowner',
            [
                'type' => 'text',
                'nullable' => true  ,
                'comment' => 'Bank',
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_payment'),
            'bankowner',
            [
                'type' => 'text',
                'nullable' => true  ,
                'comment' => 'Bank',
            ]
        );

        $setup->endSetup();
    }
}
