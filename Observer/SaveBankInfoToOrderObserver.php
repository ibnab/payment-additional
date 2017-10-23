<?php
namespace Ibnab\Additional\Observer;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\OfflinePayments\Model\Banktransfer;
class SaveBankInfoToOrderObserver implements ObserverInterface {

    protected $_inputParamsResolver;
    protected $_quoteRepository;
    protected $logger;

    public function __construct(\Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver, \Magento\Quote\Model\QuoteRepository $quoteRepository, \Psr\Log\LoggerInterface $logger) {
        $this->_inputParamsResolver = $inputParamsResolver;
        $this->_quoteRepository = $quoteRepository;
        $this->logger = $logger;
    }

    public function execute(EventObserver $observer) {
        $inputParams = $this->_inputParamsResolver->resolve();

        foreach ($inputParams as $inputParam) {
            if ($inputParam instanceof \Magento\Quote\Model\Quote\Payment) {
                $paymentData = $inputParam->getData('additional_data');
                $paymentOrder = $observer->getEvent()->getPayment();
                $order = $paymentOrder->getOrder();
                $quote = $this->_quoteRepository->get($order->getQuoteId());
                $paymentQuote = $quote->getPayment();
                $method = $paymentQuote->getMethodInstance()->getCode();
                if ($method == Banktransfer::PAYMENT_METHOD_BANKTRANSFER_CODE) {
                    if(isset($paymentData['bankowner'])){
                    $paymentQuote->setData('bankowner', $paymentData['bankowner']);
                    $paymentOrder->setData('bankowner', $paymentData['bankowner']);
                    }
                }
            }
        }

    }
}
