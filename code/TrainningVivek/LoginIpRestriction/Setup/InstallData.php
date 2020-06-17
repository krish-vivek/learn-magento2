<?php
namespace TrainningVivek\LoginIpRestriction\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    private $eavSetupFactory;
    
    private $eavConfig;
    
    private $attributeResource;
    
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->removeAttribute(Customer::ENTITY, "ip_address");

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

        $eavSetup->addAttribute(Customer::ENTITY, 'ip_address', [
            // Attribute parameters
            'type' => 'varchar',
            'label' => 'Ip Address',
            'input' => 'text',
            'required' => true,
            'visible' => true,
            'user_defined' => true,
            'sort_order' => 990,
            'position' => 990,
            'system' => 0,
            'is_used_in_grid' => true,
            'is_visible_in_grid'    => true
        ]);
        
        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'ip_address');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        $attribute->setData('used_in_forms', [
            'adminhtml_customer'
        ]);

        $this->attributeResource->save($attribute);
    }
}
?>