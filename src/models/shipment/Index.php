<?php

declare(strict_types=1);

namespace app\models\shipment;

use app\models\Customer;
use app\models\Shipment;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use yii\base\Model;
use yii\db\ActiveQuery;

class Index extends Model
{
    public ?string $customerId = null;

    private bool $filterEnabled = false;

    public ?string $invoiceDateFrom = null;

    public ?string $invoiceDateTo = null;

    public ?string $invoiceNumber = null;


    #[ArrayShape(['customerId' => "string", 'invoiceDateFrom' => "string", 'invoiceNumber' => "string"])]
    public function attributeLabels(): array
    {
        $labels = (new Shipment())->attributeLabels();

        return [
            'customerId' => $labels['customer_id'],
            'invoiceDateFrom' => $labels['invoice_date'],
            'invoiceNumber' => $labels['invoice_number'],
        ];
    }

    public function filterEnabled(): bool
    {
        return $this->filterEnabled;
    }

    public function getCustomerIdValueText(): string
    {
        if (empty($this->customerId)) {
            return '';
        }

        $customer = Customer::findOne($this->customerId);

        return sprintf('%s (%s)', $customer->name, $customer->address);
    }

    public function getQuery(): ActiveQuery
    {
        $query = Shipment::find()
            ->with(['createdBy']);

        if (null != $this->customerId) {
            $this->filterEnabled = true;
            $query->andWhere(['customer_id' => $this->customerId]);
        }

        if (null != $this->invoiceDateFrom) {
            $date = DateTime::createFromFormat('d.m.Y', $this->invoiceDateFrom);
            if ($date) {
                $this->filterEnabled = true;
                $query->andWhere(['>=', 'invoice_date', $date->format('Y-m-d')]);
            }
        }

        if (null != $this->invoiceDateTo) {
            $date = DateTime::createFromFormat('d.m.Y', $this->invoiceDateTo);
            if ($date) {
                $this->filterEnabled = true;
                $query->andWhere(['<=', 'invoice_date', $date->format('Y-m-d')]);
            }
        }

        if (null != $this->invoiceNumber) {
            $this->filterEnabled = true;
            $query->andWhere(['invoice_number' => $this->invoiceNumber]);
        }

        return $query;
    }

    public function rules(): array
    {
        return [
            ['customerId', 'safe'],

            ['invoiceDateFrom', 'safe'],

            ['invoiceDateTo', 'safe'],

            ['invoiceNumber', 'safe'],
        ];
    }
}